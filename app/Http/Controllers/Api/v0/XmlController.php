<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Picture;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use DOMDocument;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class XmlController extends Controller
{
    private $link = null;
    private $tagArr = [];
    private $catArr = [];

    public function callSchedule($data){
        if($data ==1 ){
            Artisan::call('xml:migrate refresh');
        }else{
            Artisan::call('xml:migrate');
        }
    }
    public function runQuery($data)
    {
        ini_set('memory_limit', '-1');
        // ini_set('max_execution_time','90');
        if($this->isXMLFileValid(public_path('storage/XML/Wordpress.xml'))){
            echo '1: File is valid, continuing... ' . round(memory_get_usage()/1048576,2)." megabytes" . "\n";

            if($data == 1){
                echo '2: data=1 , continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
                //Refresh migration
                try{
                    DB::beginTransaction();
                    echo '3: began transaction, continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
                    Artisan::call('migrate:refresh');
                    echo '4: migration refreshed, continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
                    $this->restore();
                    echo '5: this->restored, continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
                    DB::commit();
                    echo '6: DB comitted, continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
                    return response(['Wow!!! All data inserted successfully.']);
                }catch(QueryException $ex){
                    echo '7: Query exception, killed...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
                    DB::rollBack();
                    return response([$ex->getMessage()]);
                }
            }else{
                echo '8: data=1 , continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
                try{
                    DB::beginTransaction();
                    // Artisan::call('migrate:refresh');
                    $this->restore();
                    DB::commit();
                    return response(['Wow!!! All data inserted successfully.']);
                }catch(QueryException $ex){
                    DB::rollBack();
                    return response([$ex->getMessage()]);
                }
            }
        }
    }

    public function store(Request $req)
    {
        // if ($req->hasFile('xml')){
        //     return($req);
        // }
        // return response($req);

        ini_set('memory_limit', '-1');
        // ini_set('max_execution_time','90');
        // ini_set('post_max_size','2G');
        // ini_set('upload_max_filesize','1G');        
        if ($req->hasFile('file')) {
            $inputData = file_get_contents($req->file);
            $validate = $this->isXMLContentValid($inputData);

            if($validate != null){
                $errors = [];
                foreach($validate as $key=>$val){
                    $data =[
                        'message' => $val->message,
                        'line' => $val->line
                    ];
                    array_push($errors, $data);
                }
                return back()->with('errors', $errors);
            }else{
                $wordpressFile = 'XML/Wordpress.xml';
                Storage::put($wordpressFile, $inputData);
                // return response('Data Saved!!!');
                // file_put_contents(public_path('Wordpress.xml'), $inputData);
            }
        }

        if ($this->isXMLFileValid(public_path('storage/XML/Wordpress.xml'))) {
            // $this->restore();
        } else {
            return response(['File may not generated from Wordpress!! Please Upload a Wordpress exported file']);
            // return redirect()->route('xml-upload')->with('error', 'Invalid Xml File!! Please upload a vlaid file.');
        }
        // return redirect()->route('xml-upload')->with('success', 'Wow!!! All data inserted successfully.');
        return response(['Wow!!! All data inserted successfully.']);
    }

    public function restore(){

        $strContents = file_get_contents(public_path('storage/XML/Wordpress.xml'));
        echo '9: File get contents, continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
        $strDatas = $this->Xml2Array($strContents);
        echo '10: Xml2Array, continuing...'.  round(memory_get_usage()/1048576,2)." megabytes" . "\n";

        if (isset($strDatas['rss'])) {
            echo '11: strDatas for RSS, continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
            $this->link = (isset($strDatas['rss']['channel']['link'])) ? $strDatas['rss']['channel']['link'] : null;

            //Refresh migration
            // Artisan::call('migrate:refresh');

            if (true) { //User Converting xml done
                $this->insertUser($strDatas['rss']['channel']['wp:author']);
                echo '12: User Data Inserted , continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
            }

            if (true) { //Category Converting xml done
                $this->insertCategory($strDatas['rss']['channel']['wp:category']);
                echo '13: Category Data Inserted , continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
            }

            if (true) { //Tag Converting xml done
                // dd($strDatas['rss']['channel']['wp:tag']);
                $this->insertTag($strDatas['rss']['channel']['wp:tag']);
                echo '14: Tag Data Inserted , continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
            }

            if (true) { //Post Converting xml done
                $this->insertPostAll($strDatas['rss']['channel']['item']);
                echo '15: All Post Data Inserted , continuing...'. round(memory_get_usage()/1048576,2)." megabytes" . "\n";
            }

            Artisan::call('db:seed');

        } else {
            return response(['File may not generated from Wordpress!! Please Upload a Wordpress exported file']);
            // return back()->with('error', 'File may not generated from Wordpress!! Please Upload a Wordpress exported file');
        }
        // return redirect()->route('xml-upload')->with('success', 'Wow!!! All data inserted successfully.');
        return response(['Wow!!! All data inserted successfully.']);

    }

    private function insertPostAll($posts)
    {
        $attachments = [];

        foreach ($posts as $key => $post) {
            if (isset($post['wp:post_type']) && $post['wp:post_type'] == 'attachment') {
                $attachment= $this->arrayAttachment($post);
                if($attachment){
                    $attachments[] = $this->arrayAttachment($post);
                }
            }
        }
        if(!empty($attachments)){
            $this->insertAttachment($attachments);
        }

        foreach ($posts as $key => $post) {
            if (isset($post['wp:post_type']) && $post['wp:post_type'] == 'post') {
                $this->insertPost($post);
            } elseif (isset($post['wp:post_type']) && $post['wp:post_type'] == 'page') {
                $this->insertPage($post);
            }
        }
    }

    private function getMeta($meta, $fine)
    {
        $result = null;

        $has = array_keys(array_column($meta, 'wp:meta_key'), $fine);
        if (!empty($has)) {
            $result =  $meta[$has[0]]['wp:meta_value'];
        }
        if(isset($result)){

            if(is_string($result)){
                return $result;
            }
            if(empty($result)){
                return null;
            }

        }
        return $result;
    }
    private function insertPost($post)
    {
        $find = Post::where('id', $post['wp:post_id']);
        if (is_string($post['wp:post_name'])) {
            $find->orWhere('slug', $post['wp:post_name']);
        }
        $find = $find->first();
        if (!$find) {
            $categories = [];
            $tags = [];
            if (isset($post['category']) && is_array($post['category'])) {
                foreach ($post['category'] as $cat) {
                    if (is_array($cat)) {
                        if ($cat['domain'] == 'category') {
                            $categories[] = $this->catArr[$cat['nicename']];
                        } elseif ($cat['domain'] == 'post_tag') {
                            $tags[] = $this->tagArr[$cat['nicename']];
                        }
                    }
                }
            }

            $data = new Post();
            $data->id = $post['wp:post_id'];
            $data->title =  (is_string($post['title'])) ? $post['title'] : null;
            $data->slug = (is_string($post['wp:post_name'])) ? $post['wp:post_name'] : null;
            $data->short_description = null;
            $data->description = (is_string($post['content:encoded'])) ? $post['content:encoded'] : null;
            $data->status = ($post['wp:status'] == 'publish') ? 1 : 0;
            $data->video_link = $this->getMeta($post['wp:postmeta'], 'youtube_video_id');
            $data->created_at = $post['wp:post_date'];
            $data->updated_at = $post['wp:post_modified'];
            $data->save();
            if (!empty($tags)) {
                $data->tags()->sync($tags);
            }
            if (!empty($categories)) {
                $data->categories()->sync($categories);
            }
            $thumbnail_id = $this->getMeta($post['wp:postmeta'], '_thumbnail_id');
            if ($thumbnail_id) {
                $findPic = Picture::find($thumbnail_id);

                if ($findPic) {
                    $findPic->imageable_id = $data->id;
                    $findPic->imageable_type = Post::class;
                    $findPic->save();
                }
            }
        }
    }
    private function insertPage($post)
    {
        $find = Post::find($post['wp:post_id']);
        if (!$find) {
            $data = new Post();
            $data->id = $post['wp:post_id'];
            $data->title =  (is_string($post['title'])) ? $post['title'] : null;
            $data->slug = (is_string($post['wp:post_name'])) ? $post['wp:post_name'] : null;
            $data->short_description = null;
            $data->description = (is_string($post['content:encoded'])) ? $post['content:encoded'] : null;
            $data->status = ($post['wp:status'] == 'publish') ? 1 : 0;
            $data->video_link = null;
            $data->created_at = $post['wp:post_date'];
            $data->updated_at = $post['wp:post_modified'];
            $data->save();
        }
    }
    private function insertAttachment($data){
        $chunks = array_chunk($data,1000);
        foreach($chunks as $chunk){
            Picture::insert($chunk);
        }
    }
    private function arrayAttachment($post)
    {
        $find = Picture::find($post['wp:post_id']);
        if (!$find) {
            $img = null;
            if (is_string($post['wp:attachment_url'])) {
                $img = str_replace($this->link, "", $post['wp:attachment_url']);
            }

            $data = [];
            $data['id'] = $post['wp:post_id'];
            $data['name'] =  (is_string($post['title'])) ? $post['title'] : null;
            $data['file_name'] = (is_string($post['title'])) ? $post['title'] : null;
            $data['mime_type'] = null;
            $data['small'] = null;
            $data['medium'] = null;
            $data['full'] = $img;
            $data['thumbnail'] = null;
            $data['is_active'] =  'Yes';
            $data['attachment_meta'] = null;
            if (isset($post['wp:postmeta']) && is_array($post['wp:postmeta']) && count($post['wp:postmeta']) > 0) {
                foreach ($post['wp:postmeta'] as $list) {
                    if (isset($list['wp:meta_key']) && is_string($list['wp:meta_key']) && $list['wp:meta_key'] == '_wp_attachment_metadata') {
                        $data['attachment_meta'] = (is_string($list['wp:meta_value'])) ? $list['wp:meta_value'] : null;
                    }
                }
            }

            $data['created_at'] = $post['wp:post_date'];
            $data['updated_at'] = $post['wp:post_modified'];

           return $data;
        }
    }
    private function insertTag($tags)
    {
        $getTag = [];
        if (count($tags) > 0) {
            foreach ($tags as $index => $tag) {

                $find = Tag::find($tag['wp:term_id']);
                if (!$find) {
                    $insert = new Tag();
                    $insert->id = $tag['wp:term_id'];
                    $insert->title =  $tag['wp:tag_name'];
                    $insert->slug = $tag['wp:tag_slug'];
                    $insert->status = 1;
                    $insert->save();

                    $getTag[$insert->slug] = $insert->id;
                } else {
                    $getTag[$find->slug] = $find->id;
                }
            }
        }
        $this->tagArr = $getTag;
    }
    private function insertCategory($categories)
    {
        $getCat = [];
        if (count($categories) > 0) {
            foreach ($categories as $index => $category) {
                $find = Category::find($category['wp:term_id']);
                if (!$find) {
                    $cat = new Category();
                    $cat->id = $category['wp:term_id'];
                    $cat->title =  $category['wp:cat_name'];
                    $cat->slug = $category['wp:category_nicename'];
                    $cat->status = 1;
                    $cat->isMenu = 1;
                    $cat->save();
                    $getCat[$cat->slug] = $cat->id;
                } else {
                    $getCat[$find->slug] = $find->id;
                }
            }
        }
        $this->catArr = $getCat;
    }
    private function insertUser($author)
    {
        if (count($author) > 0) {

            if (isset($author['wp:author_id'])) {
                $find = User::find($author['wp:author_id']);
                if (!$find) {
                    $user = new User();
                    $user->id = $author['wp:author_id'];
                    $user->name =  $author['wp:author_display_name'];
                    $user->email = $author['wp:author_email'];
                    $user->password = bcrypt('News@1971');
                    $user->save();
                }
            } else {
                foreach ($author as $index => $data) {
                    $find = User::find($data['wp:author_id']);
                    if (!$find) {
                        $user = new User();
                        $user->id = $data['wp:author_id'];
                        $user->name =  $data['wp:author_display_name'];
                        $user->email = $data['wp:author_email'];
                        $user->password = bcrypt('News@1971');
                        $user->save();
                    }
                }
            }
        }
    }
    function Xml2Array($contents, $get_attributes = 1, $priority = 'tag')
    {
        if (!$contents) return array();

        if (!function_exists('xml_parser_create')) {
            //print "'xml_parser_create()' function not found!";
            return array();
        }

        //Get the XML parser of PHP - PHP must have this module for the parser to work
        $parser = xml_parser_create('');
        xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, trim($contents), $xml_values);
        xml_parser_free($parser);

        if (!$xml_values) return; //Hmm...

        //Initializations
        $xml_array = array();
        $parents = array();
        $opened_tags = array();
        $arr = array();

        $current = &$xml_array; //Refference

        //Go through the tags.
        $repeated_tag_index = array(); //Multiple tags with same name will be turned into an array
        foreach ($xml_values as $data) {
            unset($attributes, $value); //Remove existing values, or there will be trouble

            //This command will extract these variables into the foreach scope
            // tag(string), type(string), level(int), attributes(array).
            extract($data); //We could use the array by itself, but this cooler.

            $result = array();
            $attributes_data = array();

            if (isset($value)) {
                if ($priority == 'tag') $result = $value;
                else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
            }

            //Set the attributes too.
            if (isset($attributes) and $get_attributes) {
                foreach ($attributes as $attr => $val) {
                    if ($priority == 'tag') $attributes_data[$attr] = $val;
                    else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
                }
            }

            //See tag status and do the needed.
            if ($type == "open") { //The starting of the tag '<tag>'
                $parent[$level - 1] = &$current;
                if (!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
                    $current[$tag] = $result;
                    if ($attributes_data) $current[$tag . '_attr'] = $attributes_data;
                    $repeated_tag_index[$tag . '_' . $level] = 1;

                    $current = &$current[$tag];
                } else { //There was another element with the same tag name

                    if (isset($current[$tag][0])) { //If there is a 0th element it is already an array
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                        $repeated_tag_index[$tag . '_' . $level]++;
                    } else { //This section will make the value an array if multiple tags with the same name appear together
                        $current[$tag] = array($current[$tag], $result); //This will combine the existing item and the new item together to make an array
                        $repeated_tag_index[$tag . '_' . $level] = 2;

                        if (isset($current[$tag . '_attr'])) { //The attribute of the last(0th) tag must be moved as well
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset($current[$tag . '_attr']);
                        }
                    }
                    $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                    $current = &$current[$tag][$last_item_index];
                }
            } elseif ($type == "complete") { //Tags that ends in 1 line '<tag />'
                //See if the key is already taken.
                if (!isset($current[$tag])) { //New Key
                    $current[$tag] = $result;
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $attributes_data) $current[$tag . '_attr'] = $attributes_data;
                } else { //If taken, put all things inside a list(array)
                    if (isset($current[$tag][0]) and is_array($current[$tag])) { //If it is already an array...

                        // ...push the new element into that array.
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;

                        if ($priority == 'tag' and $get_attributes and $attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                        $repeated_tag_index[$tag . '_' . $level]++;
                    } else { //If it is not an array...
                        $current[$tag] = array($current[$tag], $result); //...Make it an array using using the existing value and the new value
                        $repeated_tag_index[$tag . '_' . $level] = 1;
                        if ($priority == 'tag' and $get_attributes) {
                            if (isset($current[$tag . '_attr'])) { //The attribute of the last(0th) tag must be moved as well

                                $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                                unset($current[$tag . '_attr']);
                            }

                            if ($attributes_data) {
                                $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                            }
                        }
                        $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                    }
                }
            } elseif ($type == 'close') { //End of tag '</tag>'
                $current = &$parent[$level - 1];
            }
        }

        return ($xml_array);
    }

    // XML Validate
    public function isXMLFileValid($xmlFilename, $version = '1.0', $encoding = 'utf-8')
    {
        $xmlContent = file_get_contents($xmlFilename);
        return true;
    }
    public function isXMLContentValid($xmlContent, $version = '1.0', $encoding = 'utf-8')
    {
        if (trim($xmlContent) == '') {
            return false;
        }
        libxml_use_internal_errors(true);

        $doc = new DOMDocument($version, $encoding);
        $doc->loadXML($xmlContent);

        $errors = libxml_get_errors();
        libxml_clear_errors();
        return $errors;
    }

    

}
