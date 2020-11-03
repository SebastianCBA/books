<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use Orchestra\Parser\Xml\Facade as XmlParser;


class ProcessXml implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        set_time_limit(0);
        $xml = simplexml_load_string(file_get_contents(public_path().'/xmlfiles/xml.xml'));
        foreach($xml->books->book as $node)
        {

            $item = new \Illuminate\Http\Request();
            $item->setMethod('POST');
            $item->request->add(['isbn' => $node->attributes()->isbn->__toString()]);
            $item->request->add(['title' => $node->attributes()->title->__toString()]);
            $item->request->add(['image' => $node->image->__toString()]);
            $item->request->add(['description' => $node->description->__toString()]);
            app('App\Http\Controllers\BookController')->searchorinsert($item);
            
            
        }
    }
}
