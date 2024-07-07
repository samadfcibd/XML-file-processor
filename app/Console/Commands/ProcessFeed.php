<?php

namespace App\Console\Commands;

use App\Http\Controllers\XmlDataParserController;
use App\Models\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-feed {file_path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read an XML file and store it into a database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file_path');

        if (!file_exists($file)) {
            $this->error("File not found: $file");
            Log::error("File not found: $file");
            return 1;
        }

        // Load and process data
        try {

            $ext = pathinfo($file, PATHINFO_EXTENSION);

            if ($ext == 'xml') {
                $data_parser = new XmlDataParserController();
            }
            // We can easily add another data parsing condition for different data sources e.g. Json

            $data = $data_parser->parseData($file);
        } catch (\Exception $e) {
            $this->error('Failed to load data.');
            Log::error('Failed to load data: ' . $e->getMessage());
            return 1;
        }


        // Store Data into DB
        try {
            // insert data by chunk to minimize database operation time
            foreach ($data->chunk(500) as $chunk) {
                Item::insert($chunk->toArray());
            }
        } catch (\Exception $e) {
            $this->error('Failed to process XML data.' . $e->getMessage());
            Log::error('Data processing error: ' . $e->getMessage());
            return 1;
        }

        $this->info('Data processed and inserted successfully.');
        return 0;
    }
}
