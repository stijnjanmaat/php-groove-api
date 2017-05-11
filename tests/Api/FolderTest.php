<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Folder;
use Illuminate\Support\Collection;
use Groove\Models\Folder as FolderModel;

class FolderTest extends TestCase
{
    /** @test */
    public function it_can_list_folders()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('folders', [])
            ->once()
            ->andReturn(json_decode('{"folders": [{"name": "a folder"}]}'));

        $folders = (new Folder($client))->list();

        $this->assertInstanceOf(Collection::class, $folders);
        $this->assertInstanceOf(FolderModel::class, $folders[0]);
        $this->assertEquals($folders[0]->name, 'a folder');
    }
}