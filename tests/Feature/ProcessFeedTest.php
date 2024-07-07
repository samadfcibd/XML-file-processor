<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProcessFeedTest extends TestCase
{
    /**
     * testXmlProcessing
     *
     * @return void
     */
    public function testXmlProcessing()
    {
        // Run command to process file
        $this->artisan('app:process-feed', ['file_path' => base_path('feed.xml')])
            ->assertExitCode(0);

        // Check if a record exists in the DB after processing and storing the data
        $this->assertDatabaseHas('items', [
            'entity_id' => '340'
        ]);
    }
}
