<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Layout;

class LayoutSeeder extends Seeder
{
   
    public function run()
    {   
        Layout::create([
            'title' => 'Default',
            'path' => 'theme-default',
            'status' => '1',
        ]);
        Layout::create([
            'title' => 'Voice TV',
            'path' => 'voice-tv',
            'status' => '0',
            'structure' => '{"tag": "div", "class": "", "image": "preview.jpg", "label": "root", "nodes": [{"tag": "header", "class": "voice-header", "label": "Header", "section_id": "voice-header"}, {"tag": "section", "class": "container", "label": "Marquee", "section_id": "voice-marquee-section"}, {"tag": "section", "class": "container", "nodes": [{"tag": "div", "class": "row", "nodes": [{"tag": "div", "class": "col-3", "nodes": [{"tag": "div", "class": "row", "nodes": [{"tag": "div", "class": "col-12", "label": "Main Section 1", "section_id": "voice-main-1"}, {"tag": "div", "class": "col-8", "label": "Main Section 2", "section_id": "voice-main-2"}]}]}, {"tag": "div", "class": "col-5", "label": "Main Section 3", "section_id": "voice-main-3"}, {"tag": "div", "class": "col-4", "nodes": [{"tag": "div", "class": "row", "nodes": [{"tag": "div", "class": "col-12", "label": "Live TV", "section_id": "voice-live-tv"}, {"tag": "div", "class": "col-12", "label": "Main Section 4", "section_id": "voice-main-4"}]}]}]}]}, {"tag": "section", "class": "container", "nodes": [{"tag": "div", "class": "row", "nodes": [{"tag": "div", "class": "col-5", "label": "Two Column Two Rows News Widget", "section_id": "voice-two-col-two-row"}, {"tag": "div", "class": "col-4", "label": "সব খবর", "section_id": "voice-all-news"}, {"tag": "div", "class": "col-3", "label": "Advertisement Widget Mujib 100", "section_id": "voice-advertise"}]}]}, {"tag": "section", "class": "container", "nodes": [{"tag": "div", "class": "row", "nodes": [{"tag": "div", "class": "col-6", "label": "বিনোদন", "section_id": "voice-ent"}, {"tag": "div", "class": "col-3", "label": "অপরাধ", "section_id": "voice-crime"}, {"tag": "div", "class": "col-3", "label": "জেলার সংবাদ", "section_id": "voice-dist-news"}]}]}, {"tag": "section", "class": "container", "nodes": [{"tag": "div", "class": "row", "nodes": [{"tag": "div", "class": "col-6", "label": "রাজনীতি", "section_id": "voice-politics"}, {"tag": "div", "class": "col-3", "label": "সারাদেশ", "section_id": "voice-all-country"}, {"tag": "div", "class": "col-3", "label": "Advertisement widget", "section_id": "voice-advert"}]}]}, {"tag": "section", "class": "container", "label": "Advertisement Section", "section_id": "voice-adv-sec"}, {"tag": "section", "class": "container", "label": "ভিডিও সংবাদ", "section_id": "voice-video-news"}, {"tag": "section", "class": "container", "nodes": [{"tag": "div", "class": "row", "nodes": [{"tag": "div", "class": "col-3", "label": "বিশ্ব", "section_id": "voice-world"}, {"tag": "div", "class": "col-3", "label": "খেলার খবর", "section_id": "voice-sports"}, {"tag": "div", "class": "col-6", "label": "ছবি গ্যালারি", "section_id": "voice-gallery"}]}]}, {"tag": "footer", "class": "container", "label": "Footer", "section_id": "voice-footer"}], "section_id": "root", "layout_name": "Voice TV", "layout_slug": "voice-tv"}',
        ]);
    }
}
