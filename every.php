<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */


$language = "EN";


class actions
{
    public $type;
    public $label;
    public $text;
    public $data;
    public $uri;
}
class template 
{
    public $type;
    public $text;
    public $columns;
    public $actions;
}

class buildingTemplate 
{
    public $type;
    public $columns;
    public function __construct($model, $language)
    {
        error_log('building: '.json_encode($model));
        $this->type ="carousel";
        $this->columns = array();
        $_columns = new cColumns();
        //$_columns->thumbnailImageUrl = "https://dev.wishbeer.com/image/west.jpg";
        if($language == 'EN')
        {
            $_columns->title = 'Choose your company from the list';
            $_columns->text = "Building Info:";
        }
        else{
            $_columns->title = 'เลือกชื่อบริษัทของคุณ';
            $_columns->text = "Building Info:";   
        }

        for($i = 0; $i < count($model->company); $i++)
        {
            $_actions = new actions();
            $_actions->type = "postback";
            $_actions->label = $model->company[$i]->Name;
            $_actions->data = "action=setBuilding&id=".$model->company[$i]->id;
            array_push($_columns->actions, $_actions);
        }


        array_push($this->columns, $_columns);

    }
}

class LanguageTemplate 
{
    public $type;
    public $columns;
    public function __construct($language)
    {
        
        $this->type ="carousel";
        $this->columns = array();
        $_columns = new cColumns();
        if($language == "EN")
        {
            $_columns->title = 'What language you want me to talk?';
            $_columns->text = "Language Info:";
        }
        else if($language == "TH")
        {
            $_columns->title = 'What language you want me to talk?';
            $_columns->text = "Language Info:";
        }

        
            $_actions = new actions();
            $_actions->type = "postback";
            $_actions->label = "English ";
            $_actions->data = "action=setLanguage&id=EN";
            array_push($_columns->actions, $_actions);

            $_actions = new actions();
            $_actions->type = "postback";
           
            $_actions->label = "ไทย";
            $_actions->data = "action=setLanguage&id=TH";
            array_push($_columns->actions, $_actions);
        


        array_push($this->columns, $_columns);

    }
}

class kia
{
    public $replyToken;
    public $messages;
    public function __construct($model)
    {
        
        $this->replyToken = $model;

        $this->messages = array();
        $m = new mainTemplate();
        array_push($this->messages, $m);
    }
}



class cColumns
{
    public $thumbnailImageUrl;
    public $title;
    public $text;
    public $actions;
    public function __construct()
    {
        $this->actions = array();
    }
}

class ctemplate 
{
    public $type;
    public $columns;
    public function __construct($model, $language, $PriceLimit = -1, $PriceShow = false)
    {
        $this->type ="carousel";
        $this->columns = array();

        
        if($PriceLimit == -1)
        {
            for($i = 0; $i < count($model->menu); $i++)
            {
                $Price = "";
                if($model->menu[$i]->Type == "F-Banner")
                {
                    $Price = "";
                }
                else if($PriceShow == true){
                    $Price = " ฿".$model->menu[$i]->Price;
                }
                $_columns = new cColumns();
                        //$_columns->thumbnailImageUrl = "https://dev.wishbeer.com/image/west.jpg";
                //$_columns->thumbnailImageUrl = "http://go.kinkao.co/image/".$model->menu[$i]->Image;
                $_columns->thumbnailImageUrl = "https://link.wishbeer.com/kinkao/images/".$model->menu[$i]->Image;
                if($language == "TH")
                {
                    $_columns->title = $model->menu[$i]->Title_TH.$Price;
                    $_columns->text = $model->menu[$i]->Description_TH;
                }
                else{
                    $_columns->title = $model->menu[$i]->Title.$Price;
                    $_columns->text = $model->menu[$i]->Description;
                }
                $_actions = new actions();
                $_actions->type = "postback";
                if($language == "TH")
                {
                    $_actions->label = "YES";
                }
                else{
                    $_actions->label = "YES";   
                }
                $_actions->data = 'action=order&id='.$model->menu[$i]->id;
                array_push($_columns->actions, $_actions);
                $dateofMenusplited = explode('T',$model->menu[$i]->Date);
                
                $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label =  $dateofMenusplited[0];
                $_actions->data = "nothing";
                array_push($_columns->actions, $_actions);
                array_push($this->columns, $_columns);    
            }
        } else {
            for($i = 0; $i < count($model->menu); $i++)
            {
                
                if($model->menu[$i]->Price <= $PriceLimit)
                {
                    $_columns = new cColumns();
                    //$_columns->thumbnailImageUrl = "https://dev.wishbeer.com/image/west.jpg";
                    //$_columns->thumbnailImageUrl = "http://go.kinkao.co/image/".$model->menu[$i]->Image;
                    $_columns->thumbnailImageUrl = "https://link.wishbeer.com/kinkao/images/".$model->menu[$i]->Image;
                    $Price = "";
                    if($model->menu[$i]->Type == "F-Banner")
                    {
                        $Price = "";
                    }
                    else if($PriceShow == true){
                        $Price = " ฿".$model->menu[$i]->Price;
                    }
                    if($language == "TH")
                    {
                        $_columns->title = $model->menu[$i]->Title_TH.$Price;
                        $_columns->text = $model->menu[$i]->Description_TH;
                    }
                    else{
                        $_columns->title = $model->menu[$i]->Title.$Price;
                        $_columns->text = $model->menu[$i]->Description;
                    }
                    $_actions = new actions();
                    $_actions->type = "postback";
                    if($language == "TH")
                    {
                        $_actions->label = "YES";
                    }
                    else{
                        $_actions->label = "YES";   
                    }
                    $_actions->data = 'action=order&id='.$model->menu[$i]->id;
                    array_push($_columns->actions, $_actions);
                    $dateofMenusplited = explode('T',$model->menu[$i]->Date);
                    
                    $_actions = new actions();
                    $_actions->type = "postback";
                    $_actions->label =  $dateofMenusplited[0];
                    $_actions->data = "nothing";
                    array_push($_columns->actions, $_actions);
                    array_push($this->columns, $_columns);
                }
                    
            }

        }
        

    }
}

class addresstemplate 
{
    public $type;
    public $columns;
    public function __construct($model, $language)
    {
        error_log('last'.json_encode($model));
        $this->type ="carousel";
        $this->columns = array();
        $_columns = new cColumns();
        //$_columns->thumbnailImageUrl = "https://dev.wishbeer.com/image/west.jpg";
        if($language == "EN")
        {
             $_columns->title = 'Here is your info '.$model->Name;
            $_columns->text = "Email: ".$model->Email."\nPhone: ".$model->Phone."\nCompany: ".$model->Company->Name;
            
                $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label = "Edit";
                $_actions->data = "action=edit";
                array_push($_columns->actions, $_actions);
                $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label = "Change Company";
                $_actions->data = "action=building";
                array_push($_columns->actions, $_actions);
                $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label = "Switch Language";
                $_actions->data = "action=Language";
                array_push($_columns->actions, $_actions);    
            
        
               
            
            
            
            array_push($this->columns, $_columns);
        }
        else
        {
            $_columns->title = 'ข้อมูลของ '.$model->Name;
            $_columns->text = "Email: ".$model->Email."\nPhone: ".$model->Phone."\nCompany: ".$model->Company->Name;
             $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label = "Edit";
                $_actions->data = "action=edit";
                array_push($_columns->actions, $_actions);
                $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label = "เปลี่ยนชื่อบริษัท";
                $_actions->data = "action=building";
                array_push($_columns->actions, $_actions);
                $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label = "เปลี่ยนภาษา";
                $_actions->data = "action=Language";
                array_push($_columns->actions, $_actions);    
            array_push($this->columns, $_columns);
        }
       

    }
}

class rateTemplate 
{
    public $type;
    public $columns;
    public function __construct($model, $language)
    {
        
        $this->type ="carousel";
        $this->columns = array();
        $_columns = new cColumns();
        if($language == "EN")
        {
            $_columns->thumbnailImageUrl = "https://link.wishbeer.com/kinkao/images/".$model->Food->Image;
//            $_columns->thumbnailImageUrl = "https://go.kinkao.co/image/".$model->Food->Image;
            $_columns->title = 'How was your food?';
            $_columns->text = "Do you like your menu today?";

             $_actions = new actions();
            $_actions->type = "postback";
            $_actions->label = "I like it";
            $_actions->data = "action=rate&id=".$model->Food->id."&rate=3&orderId=".$model->id;
            array_push($_columns->actions, $_actions);

            $_actions = new actions();
            $_actions->type = "postback";
           
            $_actions->label = "I don't like it";
            $_actions->data = "action=rate&id=".$model->Food->id."&rate=2&orderId=".$model->id;
            array_push($_columns->actions, $_actions);

            $_actions = new actions();
            $_actions->type = "uri";
           
            $_actions->label = "feedback";
            $_actions->uri = "http://www.kinkao.co/feedback/".$model->id."/".$model->LUID;
            array_push($_columns->actions, $_actions);

 
        


             array_push($this->columns, $_columns);
        }
        else if($language == "TH")
        {
            $_columns->thumbnailImageUrl = "https://link.wishbeer.com/kinkao/images/".$model->Food->Image;
//             $_columns->thumbnailImageUrl = "https://go.kinkao.co/image/".$model->Food->Image;
            $_columns->title = 'ให้คะแนนอาหารวันนี้?';
            $_columns->text = "คุณชอบเมนูวันนี้หรือไม่";

             $_actions = new actions();
            $_actions->type = "postback";
            $_actions->label = "ชอบ";
            $_actions->data = "action=rate&id=".$model->Food->id."&rate=3&orderId=".$model->id;
            array_push($_columns->actions, $_actions);

            $_actions = new actions();
            $_actions->type = "postback";
           
            $_actions->label = "ไม่ชอบ";
            $_actions->data = "action=rate&id=".$model->Food->id."&rate=2&orderId=".$model->id;
            array_push($_columns->actions, $_actions);

             $_actions = new actions();
            $_actions->type = "uri";
           
            $_actions->label = "feedback";
            $_actions->uri = "http://www.kinkao.co/feedback/".$model->id."/".$model->LUID;
            array_push($_columns->actions, $_actions);

             array_push($this->columns, $_columns);
        }

        
           

    }
}



class Carousel
{
    public $type;
    public $altText;
    public $template; 

    public function __construct()
    {
        

    }
    public function userInfo($model, $language)
    {
        $this->type = 'template';
        $this->altText = "This is your info";
        $this->template = new addresstemplate($model, $language);
        $this->template->type = "carousel";

    }
    public function buildingInfo($model, $language)
    {
        $this->type = 'template';
        $this->altText = "What is your building?";
        $this->template = new buildingTemplate($model, $language);
        
        $this->template->type = "carousel";

    }
    public function PushBuildingInfo($model, $language)
    {
        $this->type = 'template';
        $this->altText = "What is your building?";
        $this->template = new pushBuildingTemplate($model, $language);
        
        $this->template->type = "carousel";

    }
    public function StartLanguageInfo($model, $language)
    {
        $this->type = 'template';
        $this->altText = "What is your Language?";
        $this->template = new LanguageTemplate($language);
        
        $this->template->type = "carousel";

    }
    public function rateFood($model, $language)
    {
        $this->type = 'template';
        $this->altText = "How was your food?";
        $this->template = new rateTemplate($model, $language);
        
        $this->template->type = "carousel";

    }
    public function MenuInfo($model, $language, $name, $PriceLimit = -1, $PriceShow = true)
    {
        $this->type = 'template';
        if($language == "EN")
        {
            $this->altText = "Good morning ".$name.",  here is your menu for today";
        }
        else{
            $this->altText = "สวัสดีค่า คุณ ".$name." นี่คือเมนูของคุณในวันนี้";
        }
        $this->template = new ctemplate($model, $language, $PriceLimit, $PriceShow);

        $this->template->type = "carousel";
    }
}

class kiaCarousel{
    public $replyToken;
    public $messages;
    public $to;
    public function __construct(){

    }
   

    public function userInfo($model, $language){
        $this->replyToken = $model->replyToken;
        $this->messages = array();
        $m = new Carousel();
        $m->userInfo($model->user, $language);
        array_push($this->messages, $m);   
    }
    public function foodMenu($model,$data, $language, $name, $PriceLimit = -1, $PriceShow = false){
        $this->replyToken = $model;

        $this->messages = array();
        $m = new Carousel();
        $m->MenuInfo($data, $language, $name, $PriceLimit, $PriceShow);
        array_push($this->messages, $m);
    }
    public function foodMenu2($model,$data, $language, $name, $PriceLimit = -1, $PriceShow = false){
        $this->to = $model;

        $this->messages = array();
        $m = new Carousel();
        $m->MenuInfo($data, $language, $name, $PriceLimit, $PriceShow);
        array_push($this->messages, $m);
    }
    public function buildinglist($model, $language){
        $this->replyToken = $model->replyToken;
        $this->messages = array();
        $m = new Carousel();
        $m->BuildingInfo($model->building, $language);
        array_push($this->messages, $m);
    }
    public function rateFood($model, $language){
        $this->to = $model->LUID;
        $this->messages = array();
        $m = new Carousel();
        $m->rateFood($model, $language);
        array_push($this->messages, $m);
    }
    public function StartLanguage($model, $language){
        $this->replyToken = $model->replyToken;
        $this->messages = array();
        $m = new Carousel();
        $m->StartLanguageInfo($model, $language);
        array_push($this->messages, $m);   
    }
}

class kinkaoAPI
{

    public $HostURL;
    public function __construct()
    {
        $this->HostURL = "http://139.59.253.105:9777";
        //$this->HostURL = "http://104.236.212.53:9777";

    }
    public function userList()
    {
        $data = array('LUID' => 0);
        $url = $this->HostURL.'/user/list';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
       
            return $result;
       
    }
    public function listByCompanyBatch($id)
    {
        $data = array('bid' => $id);
        $url = $this->HostURL.'/user/listByCompanyBatch';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
       
        return $result;
    }
    public function userListByCompanyExcludeId($id)
    {
        $data = array('cid' => $id);
        $url = $this->HostURL.'/user/listByCompanyExcludeId';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
       
            return $result;
       
    }
    public function userListByCompany($id)
    {
        $data = array('cid' => $id);
        $url = $this->HostURL.'/user/listByCompany';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
       
            return $result;
       
    }
    public function orderList()
    {
        $data = array('LUID' => 0);
        $url = $this->HostURL.'/api/order/today';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
       
            return $result;
       
    }
    public function orderListTonight()
    {
        $data = array('LUID' => 0);
        $url = $this->HostURL.'/order/tonight';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
       
            return $result;
       
    }
     public function getRestaurantMenu()
    {
        $data = array('LUID' => 0);
        $url = $this->HostURL.'/menu/listRestaurant';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) {  return $result;}
        else{
            return $result;
        }

    }
    public function getRestaurantMenu2()
    {
        $data = array('LUID' => 0);
        $url = $this->HostURL.'/menu/listRestaurant2';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) {  return $result;}
        else{
            return $result;
        }

    }
    public function validateUser($LUID)
    {
        $data = array('LUID' => $LUID);
        $url = $this->HostURL.'/user/search';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { return $result;}
        else{
            return $result;
        }
    }
    public function createUser($LUID)
    {
        $data = array('LUID' => $LUID);
        $url = $this->HostURL.'/user/insertData';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { error_log('API MSG:'.json_encode($result)); return $result;}
        else{
            error_log('API MSG:'.json_encode($result));
            return $result;
        }

    }
    public function updateProfile($LUID, $DATA)
    {
        $data = array('LUID' => $LUID, 'Profile_Data'=> $DATA);
        $url = $this->HostURL.'/user/updateProfile';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { error_log('API MSG:'.json_encode($result)); return $result;}
        else{
            error_log('API MSG:'.json_encode($result));
            return $result;
        }

    }
    public function startupdate($LUID, $DATA)
    {
        $data = array('LUID' => $LUID);
        $url = $this->HostURL.'/user/startupdate';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { error_log('API MSG:'.json_encode($result)); return $result;}
        else{
            error_log('API MSG:'.json_encode($result));
            return $result;
        }

    }
    public function getMenu()
    {
        $data = array('LUID' => 0);
        $url = $this->HostURL.'/menu/list';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) {  return $result;}
        else{
            return $result;
        }

    }
    public function getBuilding()
    {
        
        $url = $this->HostURL.'/company/list';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { ; return $result;}
        else{
            return $result;
        }

    }
    public function updateProfileCompany($LUID, $DATA)
    {
        $data = array('LUID' => $LUID, 'Profile_Data'=> $DATA);
        $url = $this->HostURL.'/user/updateProfileCompany';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { error_log('API MSG:'.json_encode($result)); return $result;}
        else{
            error_log('API MSG:'.json_encode($result));
            return $result;
        }

    }
    
    public function updateProfileLanguage($LUID, $DATA)
    {
        $data = array('LUID' => $LUID, 'Profile_Data'=> $DATA);
        $url = $this->HostURL.'/user/updateProfileLanguage';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { error_log('API MSG:'.json_encode($result)); return $result;}
        else{
            
            return $result;
        }

    }
    public function createOrder($LUID, $Data)
    {
        $data = array('LUID' => $LUID, 'DATA'=> $Data);
        $url = $this->HostURL.'/order/insertData';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $json_data = file_get_contents($url, false, $context);
        $result = json_decode($json_data);
        if ($result->response === FALSE) { error_log('API MSG:'.json_encode($result)); return $result;}
        else{
            return $result;
        }
    }
}

class postBackHandler{
    
    public function __construct(){

    }
    
    public function init($model)
    {
        $result = array();
        $tempVariableSet = explode("&", $model);

        for($i = 0; $i < count($tempVariableSet); $i++)
        {
            $tempVariable = explode("=", $tempVariableSet[$i]);
            $result[$tempVariable[0]] = $tempVariable[1];            
        }

        error_log('Post Back Handler: '.json_encode($result));
        return $result;
    }
}

require_once('./LINEBotTiny.php');

// $channelAccessToken = 'ccy9H9nClBXZHMBOoBTBn3PHbIhZB3IwHLZz6Pz3iGg111NY8dbRIHWduT3sj1gPkZxCpaeGksw7gTP7PI+wJSV5XyQYP8f/HBZ/TSwEE+55jmuzAp3YX/rVj/ETMRyksHfMKLzyT817jJUAzmixNwdB04t89/1O/w1cDnyilFU=';
// $channelSecret = '4621e239316d29e51925222208e6732b';

//Production
$channelAccessToken = 'JBD1wMwPpZKIyVFgSnXO2CfsrcmbvCSHNQTpvgCiu98CfG07+LlJM5DwzP1o6f5wGTLrybj7VgLe8Dcf0bnqRA5ZbgMkga4+LHPeY06lOZLnuPOR+Uz/HNzdcvkfSfyeqajI4MMNx6GawUXTy3ZcnAdB04t89/1O/w1cDnyilFU=';
$channelSecret = '128120ac4fe583508e4e52e64a8d698c';
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
if(isset($_GET["kia"]))
{
    if($_GET["kia"] == "lovefood01")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     

        $userList = $KinkaoAPI->userList();
        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
        $menu = $KinkaoAPI->getMenu();

        
        
        $counterPush = 0;
        for($i =0; $i < count($userList); $i++)
        {

            if($userList[$i]->Company->Locked == false)
            {
                $isTodayLunch = false;
                    $LunchDay = date('l');
                   // error_log($LunchDay);
                   
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Company->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Company->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Company->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Company->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Saturday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Sunday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    error_log($userList[$i]->Name.' Company '.$userList[$i]->Company->Name.' isTodayLunch '.$isTodayLunch, 3, "/var/tmp/my-logs.log");
                    if($isTodayLunch == true )
                    {
                        if(count($nonKinkaoMenu->menu) > 0)
                        {
                            $c = new kiaCarousel();
                            $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $userList[$i]->Language, $userList[$i]->Name);
                            $client->pushMessage($c);
                        }
                    
                        if(count($nonKinkaoMenu2->menu) > 0)
                        {
                            $kc = new kiaCarousel();
                            $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $userList[$i]->Language, $userList[$i]->Name);
                            $client->pushMessage($kc);
                        }

                        
                        if(count($menu->menu) > 0)
                        {   
                
                            $test = new kiaCarousel();
                            $test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Name);
                            $client->pushMessage($test);
                            
                        }
                    }

                
            }
           
           
            
            
           
             $counterPush++;
        }
        
        error_log('Counter Push'.$counterPush." User Number: ".count($userList)."\n", 3, "/var/tmp/my-errors.log");
        
    }
    if($_GET["kia"] == "lovefood02")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     

        $userList = $KinkaoAPI->userList();
        $test = new kiaCarousel();

        
//        error_log("start".$userList[$i]->Name.''.$userList[$i]->Company->Name);
        for($i =0; $i < count($userList); $i++)
        {
            //$language = "EN";
         //   print_r($userList[$i]);

            //$test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Name);
            if(isset($userList[$i]->Language))
            {
                if($userList[$i]->Company->Locked == false)
                {
                    $isTodayLunch = false;
                    $LunchDay = date('l');
                 //   error_log($LunchDay);
                  
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Company->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Company->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Company->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Company->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    
                   
                    if($isTodayLunch == true )
                    {  
                        
                        error_log("can have lunch".$userList[$i]->Name.''.$userList[$i]->Company->Name, 3, "/var/tmp/my-logs.log");
                        if($userList[$i]->Locked == 0)
                        {
                            if( $userList[$i]->Language == "EN")
                            {
                                
                                $client->pushMessage(array(
                                    'to' => $userList[$i]->LUID,
                                    'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => "Hi there! If you haven't ordered already today, don't forget to click 'YES' before 10am"
                                            )
                                        )
                                    )
                                );
                            }else{
                                $client->pushMessage(array(
                                    'to' => $userList[$i]->LUID,
                                    'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => "สวัสดีค่า ถ้าวันนี้คุณยังไม่สั่ง  อย่าลืมคลิก 'YES' ก่อน 10.00น. นะคะ"
                                            )
                                        )
                                    )
                                );
                                
                            }
                        }
                        
                    }
                }
                
            }
        }
    }
    if($_GET["kia"] == "lovefood03")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     

        $userList = $KinkaoAPI->userList();
        $test = new kiaCarousel();

        
        
         for($i =0; $i < count($userList); $i++)
        {
            $client->getProfile($userList[$i]->LUID);
        }
    }
    if($_GET["kia"] == "lovefood04")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     

        $orderList = $KinkaoAPI->orderList();
        $kc = new kiaCarousel();

        
        
        for($i = 0; $i < count($orderList->order); $i++)
        {
             
           
              
               
                $kc->rateFood($orderList->order[$i], $orderList->order[$i]->Owner->Language);
                $client->pushMessage($kc);
            
            
            
        }
    }
    if($_GET["kia"] == "lovefood04TN")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     

        $orderList = $KinkaoAPI->orderListTonight();
        $kc = new kiaCarousel();

        
        
        for($i = 0; $i < count($orderList->order); $i++)
        {
             
           
              
               
                $kc->rateFood($orderList->order[$i], $orderList->order[$i]->Owner->Language);
                $client->pushMessage($kc);
            
            
            
        }
    }
  
   if($_GET["kia"] == "lovefood06")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     
      
        $userList = $KinkaoAPI->userListByCompany(13);
        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
        $menu = $KinkaoAPI->getMenu();

        
       
        $counterPush = 0;
        for($i =0; $i < count($userList); $i++)
        {


            if($userList[$i]->Company->Locked == false)
            {
                $isTodayLunch = false;
                    $LunchDay = date('l');
                   // error_log($LunchDay);
                   
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Company->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Company->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Company->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Company->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Saturday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Sunday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
              
                    error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->Name.' Company '.$userList[$i]->Company->Name.' isTodayLunch '.$isTodayLunch."\n ", 3, "/var/tmp/my-logs.log");
                    if($isTodayLunch == true )
                    {
                        if($userList[$i]->Company->StreetStatus == 1)
                        {
                            if(count($nonKinkaoMenu->menu) > 0)
                            {
                                $c = new kiaCarousel();
                                $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($c);
                            }
                        }
                        if($userList[$i]->Company->FeatureStatus == 1)
                        {
                            if(count($nonKinkaoMenu2->menu) > 0)
                            {
                                $kc = new kiaCarousel();
                                $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($kc);
                            }
                        }

                        if($userList[$i]->Company->KinkaoStatus == 1)
                        {
                            if(count($menu->menu) > 0)
                            {   
                    
                                $test = new kiaCarousel();
                                $test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($test);
                                
                            }
                        }
                        
                    }

                
            }
           
           
            
            
           
             $counterPush++;
        }
       
        error_log('['.date("F j, Y, g:i a e O").']'.'Counter Push'.$counterPush." User Number: ".count($userList)."\n ", 3, "/var/tmp/my-errors.log");
    }
    if($_GET["kia"] == "lovefood16")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     
      
        $userList = $KinkaoAPI->userListByCompany(12);
        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
        $menu = $KinkaoAPI->getMenu();

        
       
        $counterPush = 0;
        for($i =0; $i < count($userList); $i++)
        {


            if($userList[$i]->Company->Locked == false)
            {
                $isTodayLunch = false;
                    $LunchDay = date('l');
                   // error_log($LunchDay);
                   
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Company->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Company->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Company->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Company->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Saturday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Sunday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
              
                    error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->Name.' Company '.$userList[$i]->Company->Name.' isTodayLunch '.$isTodayLunch."\n ", 3, "/var/tmp/my-logs.log");
                    
                    if($isTodayLunch == true )
                    {
                         
                        if($userList[$i]->Company->StreetStatus == 1)
                        {
                            if(count($nonKinkaoMenu->menu) > 0)
                            {
                                $c = new kiaCarousel();
                                $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($c);
                            }
                        }
                        if($userList[$i]->Company->FeatureStatus == 1)
                        {
                            if(count($nonKinkaoMenu2->menu) > 0)
                            {
                                $kc = new kiaCarousel();
                                $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($kc);
                            }
                        }

                        if($userList[$i]->Company->KinkaoStatus == 1)
                        {
                            if(count($menu->menu) > 0)
                            {   
                    
                                $test = new kiaCarousel();
                                $test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($test);
                                
                            }
                        }
                    }

                
            }
           
           
            
            
           
             $counterPush++;
        }
       
        error_log('['.date("F j, Y, g:i a e O").']'.'Counter Push'.$counterPush." User Number: ".count($userList)."\n ", 3, "/var/tmp/my-errors.log");
    }
    if($_GET["kia"] == "lovefood07")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     
      
        $userList = $KinkaoAPI->userListByCompanyExcludeId(13);
        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
        $menu = $KinkaoAPI->getMenu();

        
       
        $counterPush = 0;
        for($i =0; $i < count($userList); $i++)
        {


            if($userList[$i]->Company->Locked == false)
            {
                $isTodayLunch = false;
                    $LunchDay = date('l');
              //      error_log($LunchDay);
                   
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Company->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Company->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Company->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Company->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Saturday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Sunday')
                    {
                        if($userList[$i]->Company->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                   
                    error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->Name.' Company '.$userList[$i]->Company->Name.' isTodayLunch '.$isTodayLunch."\n ", 3, "/var/tmp/my-logs.log");
                    if($isTodayLunch == true )
                    {
                        
                        if($userList[$i]->Company->StreetStatus == 1)
                        {
                            if(count($nonKinkaoMenu->menu) > 0)
                            {
                                $c = new kiaCarousel();
                                $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($c);
                            }
                        }
                        if($userList[$i]->Company->FeatureStatus == 1)
                        {
                            if(count($nonKinkaoMenu2->menu) > 0)
                            {
                                $kc = new kiaCarousel();
                                $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($kc);
                            }
                        }

                        if($userList[$i]->Company->KinkaoStatus == 1)
                        {
                            if(count($menu->menu) > 0)
                            {   
                    
                                $test = new kiaCarousel();
                                $test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Name, $userList[$i]->Company->PriceLimit, $userList[$i]->Company->ShowPrice);
                                $client->pushMessage($test);
                                
                            }
                        }
                        error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->LUID." PUSHED \n", 3, "/var/tmp/my-logs.log");
                    }

                
            }
           
           
            
            
           
             $counterPush++;
        }
      
        error_log('['.date("F j, Y, g:i a e O").']'.'Counter Push'.$counterPush." User Number: ".count($userList)."\n ", 3, "/var/tmp/my-errors.log");
    }

    if($_GET["kia"] == "lovefood17N2")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     
      
        $userList = $KinkaoAPI->listByCompanyBatch(3);
        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
        $menu = $KinkaoAPI->getMenu();
        // echo "<pre>";
        // print_r($userList);
       
        $counterPush = 0;
        for($i =0; $i < count($userList); $i++)
        {


            if($userList[$i]->Locked == false)
            {
                $isTodayLunch = false;
                    $LunchDay = date('l');
              //      error_log($LunchDay);
                   
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Saturday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Sunday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                   
                    error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->Username.' Company '.$userList[$i]->CompanyName.' isTodayLunch '.$isTodayLunch."\n ", 3, "/var/tmp/my-logs.log");
                    if($isTodayLunch == true )
                    {
                        //echo '['.date("F j, Y, g:i a e O").']'.$userList[$i]->Username.' Company '.$userList[$i]->CompanyName.' isTodayLunch '.$isTodayLunch."<br/> ";
                        if($userList[$i]->ULocked == 0)
                        {
                            if($userList[$i]->StreetStatus == 1)
                            {
                                if(count($nonKinkaoMenu->menu) > 0)
                                {
                                    $c = new kiaCarousel();
                                    $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($c);
                                }
                            }
                            if($userList[$i]->FeatureStatus == 1)
                            {
                                if(count($nonKinkaoMenu2->menu) > 0)
                                {
                                    $kc = new kiaCarousel();
                                    $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($kc);
                                }
                            }

                            if($userList[$i]->KinkaoStatus == 1)
                            {
                                if(count($menu->menu) > 0)
                                {   
                        
                                    $test = new kiaCarousel();
                                    $test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($test);
                                    
                                }
                            }    
                        }
                        
                        error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->LUID." PUSHED \n", 3, "/var/tmp/my-logs.log");
                    }

                
            }
           
           
            
            
           
             $counterPush++;
        }
      
        error_log('['.date("F j, Y, g:i a e O").']'.'Counter Push'.$counterPush." User Number: ".count($userList)."\n ", 3, "/var/tmp/my-errors.log");
    }
    if($_GET["kia"] == "lovefood17N4")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     
      
        $userList = $KinkaoAPI->listByCompanyBatch(4);
        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
        $menu = $KinkaoAPI->getMenu();
        // echo "<pre>";
        // print_r($userList);
       
        $counterPush = 0;
        for($i =0; $i < count($userList); $i++)
        {


            if($userList[$i]->Locked == false)
            {
                $isTodayLunch = false;
                    $LunchDay = date('l');
              //      error_log($LunchDay);
                   
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Saturday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Sunday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                   
                    error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->Username.' Company '.$userList[$i]->CompanyName.' isTodayLunch '.$isTodayLunch."\n ", 3, "/var/tmp/my-logs.log");
                    if($isTodayLunch == true )
                    {
                        //echo '['.date("F j, Y, g:i a e O").']'.$userList[$i]->Username.' Company '.$userList[$i]->CompanyName.' isTodayLunch '.$isTodayLunch."<br/> ";
                        
                        if($userList[$i]->ULocked == 0)
                        {
                            if($userList[$i]->StreetStatus == 1)
                            {
                                if(count($nonKinkaoMenu->menu) > 0)
                                {
                                    $c = new kiaCarousel();
                                    $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($c);
                                }
                            }
                            if($userList[$i]->FeatureStatus == 1)
                            {
                                if(count($nonKinkaoMenu2->menu) > 0)
                                {
                                    $kc = new kiaCarousel();
                                    $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($kc);
                                }
                            }

                            if($userList[$i]->KinkaoStatus == 1)
                            {
                                if(count($menu->menu) > 0)
                                {   
                        
                                    $test = new kiaCarousel();
                                    $test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($test);
                                    
                                }
                            }    
                        }
                        error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->LUID." PUSHED \n", 3, "/var/tmp/my-logs.log");
                    }

                
            }
             $counterPush++;
        }
      
        error_log('['.date("F j, Y, g:i a e O").']'.'Counter Push'.$counterPush." User Number: ".count($userList)."\n ", 3, "/var/tmp/my-errors.log");
    }
    if($_GET["kia"] == "lovefood17N5")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     
      
        $userList = $KinkaoAPI->listByCompanyBatch(5);
        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
        $menu = $KinkaoAPI->getMenu();
        // echo "<pre>";
        // print_r($userList);
       
        $counterPush = 0;
        for($i =0; $i < count($userList); $i++)
        {


            if($userList[$i]->Locked == false)
            {
                $isTodayLunch = false;
                    $LunchDay = date('l');
              //      error_log($LunchDay);
                   
                    if($LunchDay == 'Monday')
                    {
                        if($userList[$i]->Tuesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Tuesday')
                    {
                        if($userList[$i]->Wednesday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Wednesday')
                    {
                        if($userList[$i]->Thursday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Thursday')
                    {
                        if($userList[$i]->Friday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Friday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Saturday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                    else if($LunchDay == 'Sunday')
                    {
                        if($userList[$i]->Monday == true)
                        {
                            $isTodayLunch = true;
                        }
                    }
                   
                    error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->Username.' Company '.$userList[$i]->CompanyName.' isTodayLunch '.$isTodayLunch."\n ", 3, "/var/tmp/my-logs.log");
                    if($isTodayLunch == true )
                    {
                        //echo '['.date("F j, Y, g:i a e O").']'.$userList[$i]->Username.' Company '.$userList[$i]->CompanyName.' isTodayLunch '.$isTodayLunch."<br/> ";
                        if($userList[$i]->ULocked == 0)
                        {
                            if($userList[$i]->StreetStatus == 1)
                            {
                                if(count($nonKinkaoMenu->menu) > 0)
                                {
                                    $c = new kiaCarousel();
                                    $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($c);
                                }
                            }
                            if($userList[$i]->FeatureStatus == 1)
                            {
                                if(count($nonKinkaoMenu2->menu) > 0)
                                {
                                    $kc = new kiaCarousel();
                                    $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($kc);
                                }
                            }

                            if($userList[$i]->KinkaoStatus == 1)
                            {
                                if(count($menu->menu) > 0)
                                {   
                        
                                    $test = new kiaCarousel();
                                    $test->foodMenu2($userList[$i]->LUID, $menu, $userList[$i]->Language, $userList[$i]->Username, $userList[$i]->PriceLimit, $userList[$i]->ShowPrice);
                                    $client->pushMessage($test);
                                    
                                }
                            }    
                        }
                        
                        error_log('['.date("F j, Y, g:i a e O").']'.$userList[$i]->LUID." PUSHED \n", 3, "/var/tmp/my-logs.log");
                    }

                
            }
           
           
            
            
           
             $counterPush++;
        }
      
        error_log('['.date("F j, Y, g:i a e O").']'.'Counter Push'.$counterPush." User Number: ".count($userList)."\n ", 3, "/var/tmp/my-errors.log");
    }
    if($_GET["kia"] == "registerDone")
    {
        $KinkaoAPI = new kinkaoAPI();
        
     

        $userList = $KinkaoAPI->userList();
        $test = new kiaCarousel();

        
        $client->pushMessage(array(
            'to' => $_GET["LUID"],
            'messages' => array(
                    array(
                        'type' => 'text',
                        'text' => 'Welcome to Kinkao! Type "menu" to see today meal!'
                    )
                )
            )
        );
    }
}

