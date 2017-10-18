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

        $this->type ="carousel";
        $this->columns = array();
        $countCompany = 0;
        $actionNumber = 3;
        for($i = 0; $i < count($model->company)/$actionNumber;$i++)
        {

            for($j=0; $j < $actionNumber; $j++)
            {
                if($j==0)
                {
                    $_columns = new cColumns();
                    if($language == 'EN')
                    {
                        $_columns->title = 'Choose your company from the list';
                        $_columns->text = "Building Info:";
                    }
                    else{
                        $_columns->title = 'เลือกชื่อบริษัทของคุณ';
                        $_columns->text = "Building Info:";   
                    }

                    $_actions = new actions();
                    $_actions->type = "postback";
                    $_actions->label = $model->company[$j+($i*$actionNumber)]->Name;
                    $_actions->data = "action=setBuilding&id=".$model->company[$j+($i*$actionNumber)]->id;
                    array_push($_columns->actions, $_actions);
                }
                else if($j== $actionNumber-1){

                    if($j+($i*$actionNumber) < count($model->company))
                    {
                        $_actions = new actions();
                        $_actions->type = "postback";
                        $_actions->label = $model->company[$j+($i*$actionNumber)]->Name;
                        $_actions->data = "action=setBuilding&id=".$model->company[$j+($i*$actionNumber)]->id;
                        array_push($_columns->actions, $_actions);
                        array_push($this->columns, $_columns);    
                    }
                    else{
                        $_actions = new actions();
                        $_actions->type = "postback";
                        $_actions->label = "...";
                        $_actions->data = "nothing";
                        array_push($_columns->actions, $_actions);
                        array_push($this->columns, $_columns);    
                    }
                    

                }
                else{
                     if($j+($i*$actionNumber) < count($model->company))
                    {
                        $_actions = new actions();
                        $_actions->type = "postback";
                        $_actions->label = $model->company[$j+($i*$actionNumber)]->Name;
                        $_actions->data = "action=setBuilding&id=".$model->company[$j+($i*$actionNumber)]->id;
                        array_push($_columns->actions, $_actions);
                      
                    }
                    else{
                        $_actions = new actions();
                    $_actions->type = "postback";
                    $_actions->label = "...";
                    $_actions->data = "nothing";
                        array_push($_columns->actions, $_actions);
                      
                    }
                    

                }
            }

        }
    }
}
class pushBuildingTemplate 
{
    public $type;
    public $columns;
    public function __construct($model, $language)
    {

        $this->type ="carousel";
        $this->columns = array();
        $countCompany = 0;
        $actionNumber = 3;
        for($i = 0; $i < count($model->company)/$actionNumber;$i++)
        {

            for($j=0; $j < $actionNumber; $j++)
            {
                if($j==0)
                {
                    $_columns = new cColumns();
                    //$_columns->thumbnailImageUrl = "https://dev.wishbeer.com/image/west.jpg";
                    if($language == 'EN')
                    {
                        $_columns->title = 'Choose Your Building To blast';
                        $_columns->text = "Building Info:";
                    }
                    else{
                        $_columns->title = 'เลือกชื่อบริษัทของคุณ';
                        $_columns->text = "Building Info:";   
                    }

                    $_actions = new actions();
                    $_actions->type = "postback";
                    $_actions->label = $model->company[$j+($i*$actionNumber)]->Name;
                    $_actions->data = "action=PushBuilding&id=".$model->company[$j+($i*$actionNumber)]->id;
                    array_push($_columns->actions, $_actions);
                }
                else if($j== $actionNumber-1){

                    if($j+($i*$actionNumber) < count($model->company))
                    {
                        $_actions = new actions();
                        $_actions->type = "postback";
                        $_actions->label = $model->company[$j+($i*$actionNumber)]->Name;
                        $_actions->data = "action=PushBuilding&id=".$model->company[$j+($i*$actionNumber)]->id;
                        array_push($_columns->actions, $_actions);
                        array_push($this->columns, $_columns);    
                    }
                    else{
                          $_actions = new actions();
                    $_actions->type = "postback";
                    $_actions->label = "...";
                    $_actions->data = "nothing";
                        array_push($_columns->actions, $_actions);
                        array_push($this->columns, $_columns);    
                    }
                    

                }
                else{
                    if($j+($i*$actionNumber) < count($model->company))
                    {
                        $_actions = new actions();
                        $_actions->type = "postback";
                        $_actions->label = $model->company[$j+($i*$actionNumber)]->Name;
                        $_actions->data = "action=PushBuilding&id=".$model->company[$j+($i*$actionNumber)]->id;
                        array_push($_columns->actions, $_actions);
                      
                    }
                    else{
                        $_actions = new actions();
                    $_actions->type = "postback";
                    $_actions->label = "...";
                    $_actions->data = "nothing";
                        array_push($_columns->actions, $_actions);
                      
                    }
                    

                }
            }

        }

       

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
                        $Price = $model->menu[$i]->Price;
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
class cheftemplate 
{
    public $type;
    public $columns;
    public function __construct()
    {
        $this->type ="carousel";
        $this->columns = array();

        

            $_columns = new cColumns();
            $_columns->thumbnailImageUrl = "https://go.kinkao.co/image/kevin.jpg";
          
            $_columns->title = "Take home Celebrity Chef";
            $_columns->text = "and dine in the comfort of your own home";
            
            $_actions = new actions();
            $_actions->type = "postback";
            $_actions->label = "inquiry";
            $_actions->data = "action=inquiry";
            array_push($_columns->actions, $_actions);
            $_actions = new actions();
            $_actions->type = "postback";
            $_actions->label = "Details";
            $_actions->data = "action=xbuilding";
            array_push($_columns->actions, $_actions);
            array_push($this->columns, $_columns);    
       
        

    }
}
class addresstemplate 
{
    public $type;
    public $columns;
    public function __construct($model, $language)
    {
        $this->type ="carousel";
        $this->columns = array();
        $_columns = new cColumns();
        //$_columns->thumbnailImageUrl = "https://dev.wishbeer.com/image/west.jpg";
        if($language == "EN")
        {
             $_columns->title = 'Here is your info '.$model->Name;
            $_columns->text = "".$model->Email."\n".$model->Phone."\n".$model->Company->Name;
            
                // $_actions = new actions();
                // $_actions->type = "postback";
                // $_actions->label = "Edit";
                // $_actions->data = "action=edit";
                // array_push($_columns->actions, $_actions);
                // $_actions = new actions();
                // $_actions->type = "postback";
                // $_actions->label = "Change Company";
                // $_actions->data = "action=building";
                // array_push($_columns->actions, $_actions);
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
            $_columns->text = " ".$model->Email."\n ".$model->Phone."\n ".$model->Company->Name;
            //  $_actions = new actions();
            //     $_actions->type = "postback";
            //     $_actions->label = "Edit";
            //     $_actions->data = "action=edit";
            //     array_push($_columns->actions, $_actions);
            //     $_actions = new actions();
            //     $_actions->type = "postback";
            //     $_actions->label = "เปลี่ยนชื่อบริษัท";
            //     $_actions->data = "action=building";
            //     array_push($_columns->actions, $_actions);
                $_actions = new actions();
                $_actions->type = "postback";
                $_actions->label = "เปลี่ยนภาษา";
                $_actions->data = "action=Language";
                array_push($_columns->actions, $_actions);    
            array_push($this->columns, $_columns);
        }
       

    }
}
class lineRegTemplate 
{
    public $type;
    public $columns;
    public function __construct($LUID, $language = "EN")
    {
        $this->type ="carousel";
        $this->columns = array();
        $_columns = new cColumns();
        //$_columns->thumbnailImageUrl = "https://dev.wishbeer.com/image/west.jpg";
        if($language == "EN")
        {
            $_columns->title = 'Registration';
            $_columns->text = "Let start getting you into your Company";
            $_actions = new actions();
            $_actions->type = "uri";
            $_actions->label = "Register";
            $_actions->uri = "http://www.kinkao.co/registration/line/en/".$LUID;
            array_push($_columns->actions, $_actions);
            $_actions = new actions();
            $_actions->type = "uri";
            $_actions->label = "สมัคร";
            $_actions->uri = "http://www.kinkao.co/registration/line/th/".$LUID;
            array_push($_columns->actions, $_actions);    
            array_push($this->columns, $_columns);
        }
        else
        {
             $_columns->title = 'Registration';
            $_columns->text = "Let start getting you into your Company";
            $_actions = new actions();
            $_actions->type = "uri";
            $_actions->label = "Register";
            $_actions->uri = "http://www.kinkao.co/registration/line/en/".$LUID;
            array_push($_columns->actions, $_actions);
            $_actions = new actions();
            $_actions->type = "uri";
            $_actions->label = "สมัคร";
            $_actions->uri = "http://www.kinkao.co/registration/line/th/".$LUID;
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
    public function lineReg($model, $language)
    {
        $this->type = 'template';
        $this->altText = "Let start cooking your account";
        $this->template = new lineRegTemplate($model, $language);
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
    public function chefList()
    {
        $this->type= "template";
        $this->altText = "Chef Selection";

        $this->template = new cheftemplate();
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
    public function registrationLine($model, $language){
        $this->replyToken = $model->replyToken;
        $this->messages = array();
        $m = new Carousel();
        $m->lineReg($model->LUID, $language);
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
    public function pushbuildinglist($model, $language, $LUID){
        $this->to = $LUID;
        $this->messages = array();
        $m = new Carousel();
        $m->BuildingInfo($model->building, $language);
        array_push($this->messages, $m);
    }
    public function PushBuilding($model, $language, $LUID){
        $this->to = $LUID;
        $this->messages = array();
        $m = new Carousel();
        $m->PushBuildingInfo($model->building, $language);
        array_push($this->messages, $m);
    }
    public function PushChef($Token){
        $this->replyToken = $Token;
        $this->messages = array();
        $m = new Carousel();
        $m->chefList();
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
        // ME
        $this->HostURL = "http://139.59.247.234:1337";
        //
        // $this->HostURL = "http://139.59.253.105:9777";
        //$this->HostURL = "http://104.236.212.53:9777";
    }
    public function userList()
    {
        $data = array('LUID' => $LUID);
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
    public function CompanyOrderList($data)
    {
        $data = array('company_Name' => $data);
        $url = $this->HostURL.'/Order/OrderCompanyList';
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
        if ($result->response === FALSE) {  return $result;}
        else{
            return $result;
        }

    }
    public function updateProfile($LUID, $DATA, $mode)
    {
        $data = array('LUID' => $LUID, 'Profile_Data'=> $DATA, 'mode' => $mode);
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
        if ($result->response === FALSE) {  return $result;}
        else{
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
        if ($result->response === FALSE) {  return $result;}
        else{
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
        if ($result->response === FALSE) { return $result;}
        else{

            return $result;
        }

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
        if ($result->response === FALSE) { return $result;}
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
        if ($result->response === FALSE) { return $result;}
        else{
            return $result;
        }

    }
    public function getBuilding()
    {
        $data = "";
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
        if ($result->response === FALSE) { return $result;}
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
        if ($result->response === FALSE) {  return $result;}
        else{
            return $result;
        }

    }
    public function RateFood($LUID, $ORDERID, $FOODID, $RATE)
    {
        $data = array('LUID' => $LUID, 'ORDERID'=> $ORDERID, 'FOODID'=>$FOODID, 'RATE'=>$RATE);
        $url = $this->HostURL.'/order/ratefood';
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
        if ($result->response === FALSE) { return $result;}
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
        if ($result->response === FALSE) {  return $result;}
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

// ME
$channelAccessToken = 'mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=';
$channelSecret = '5bf3f6d2e27576b55d4282e89ad66f97';

// $channelAccessToken = 'ccy9H9nClBXZHMBOoBTBn3PHbIhZB3IwHLZz6Pz3iGg111NY8dbRIHWduT3sj1gPkZxCpaeGksw7gTP7PI+wJSV5XyQYP8f/HBZ/TSwEE+55jmuzAp3YX/rVj/ETMRyksHfMKLzyT817jJUAzmixNwdB04t89/1O/w1cDnyilFU=';
// $channelSecret = '4621e239316d29e51925222208e6732b';

// $channelAccessToken = 'JBD1wMwPpZKIyVFgSnXO2CfsrcmbvCSHNQTpvgCiu98CfG07+LlJM5DwzP1o6f5wGTLrybj7VgLe8Dcf0bnqRA5ZbgMkga4+LHPeY06lOZLnuPOR+Uz/HNzdcvkfSfyeqajI4MMNx6GawUXTy3ZcnAdB04t89/1O/w1cDnyilFU=';
// $channelSecret = '128120ac4fe583508e4e52e64a8d698c';
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$client->myPushMessage();
foreach ($client->parseEvents() as $event) {

    $KinkaoAPI = new kinkaoAPI();
    
    $LUID = $event['source']['userId'];
    
    $userKinkao = $KinkaoAPI->validateUser($LUID);
    if($userKinkao->user->Locked == true)
    {
        $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Your account is locked, please contact K. Kae 087-518-6178 to unlock your account.'
                )
            )
        ));
        break;

    }
    else if($userKinkao->response == true && $userKinkao->user->Step == 0)
    {
        $language = $userKinkao->user->Language;
        if($event['type'] == 'message')
        {
            $message = $event['message'];
            if($message['type'] == 'text')
            {
                if($message['text'] == 'karrived' || $message['text'] == 'Karrived')
                {
                    // $building = $KinkaoAPI->getBuilding();
                    // $model = (object) ['replyToken'=> $event['replyToken'], 'building' => $building];
                        
                    // $kinkao = new kiaCarousel();
                    // $kinkao->PushBuilding($model, $language);
                    // $client->replyMessage($kinkao);

                    $building = $KinkaoAPI->getBuilding();
                    $buildingSingle = array();
                    $buildingList = array();
                    $companyCount = 0;

                    $companyCount = count($building->company)-1;
                    for($i = 0; $i < count($building->company); $i++)
                    {
                        $modu =0;
                        $modu = $i % 14;
                        error_log($i.' % 15 = '.$modu);
                    
                        error_log(' -1 counter'.$companyCount);
                        if($i == 0)
                        {
                            array_push($buildingSingle, $building->company[$i]);

                        }
                        else if($i == $companyCount)
                        {
                            array_push($buildingSingle, $building->company[$i]);
                            array_push($buildingList, $buildingSingle);
                            $buildingSingle = array();
                        }
                        else if( $modu != 0)
                        {
                            array_push($buildingSingle, $building->company[$i]);
                        }
                        else if( $modu == 0){
                            array_push($buildingSingle, $building->company[$i]);
                            array_push($buildingList, $buildingSingle);
                            $buildingSingle = array();
                        }
                        
                        

                    }
                    
                    for($i =0; $i <count($buildingList); $i++)
                    {
                        $building->company = $buildingList[$i];
                    
                        $model = (object) ['replyToken'=> $event['replyToken'], 'building' => $building];
                        
                        $kinkao = new kiaCarousel();
                        $kinkao->PushBuilding($model, $language, $userKinkao->user->LUID);
                        $client->pushMessage($kinkao);
                    }
                    break;
                }
                if($message['text'] == 'chef' || $message['text'] == 'Chef')
                {
                 
                    $model = $event['replyToken'];
                        
                    $kinkao = new kiaCarousel();
                    $kinkao->PushChef($model);
                    $client->replyMessage($kinkao);
                    break;
                }
                if($message['text'] == 'lineReg' || $message['text'] == 'linereg')
                {
                 
                    $model = (object) ['replyToken'=> $event['replyToken'], 'user' => $userKinkao->user];
                        
                    $kinkao = new kiaCarousel();
                    $kinkao->registrationLine($model, $language);
                    $client->replyMessage($kinkao);
                    break;
                }
                
                else if($message['text']== 'Hi')
                {
                    $client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => 'Hi '.$userKinkao->user->Name,
                            )
                        )
                    ));
                    break;
                }
                else if($message['text']== 'Credit' || $message['text']== 'credit')
                {
                    $client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => 'Hi '.$userKinkao->user->Name.', you have ฿'.$userKinkao->user->Credit.' Credits and ฿'.$userKinkao->user->PersonalCredit.' Personal Credit',
                            )
                        )
                    ));
                    break;
                }
                else if($message['text'] == 'info' || $message['text'] == 'Info')
                {
                    $model = (object) ['replyToken'=> $event['replyToken'], 'user' => $userKinkao->user];
                    
                    $test = new kiaCarousel();
                    $test->userInfo($model, $language);
                    $client->replyMessage($test);
                    break;   
                }
               
                else if($message['text'] == 'Lunch' || $message['text'] == 'lunch' || $message['text'] == 'menu' || $message['text'] == 'Menu' )
                {

                    
                    if($userKinkao->user->Company->StreetStatus == 1)
                    {
                        $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
                        if(count($nonKinkaoMenu->menu) > 0)
                        {
                            error_log('in 1');
                            $c = new kiaCarousel();
                            $client = new LINEBotTiny($channelAccessToken, $channelSecret);
                            $c->foodMenu2($userKinkao->user->LUID, $nonKinkaoMenu, $language, $userKinkao->user->Name, $userKinkao->user->Company->PriceLimit, $userKinkao->user->Company->ShowPrice);
                            $client->pushMessage($c);
                        }
                    }
                    if($userKinkao->user->Company->FeatureStatus == 1)
                    {
                        $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
                    
                        if(count($nonKinkaoMenu2->menu) > 0)
                        {
                            error_log('in 2');
                            $kc = new kiaCarousel();
                            $client = new LINEBotTiny($channelAccessToken, $channelSecret);
                            $kc->foodMenu2($userKinkao->user->LUID, $nonKinkaoMenu2, $language, $userKinkao->user->Name, $userKinkao->user->Company->PriceLimit, $userKinkao->user->Company->ShowPrice);
                            error_log(json_encode($kc));
                            $client->pushMessage($kc);
                        }
                    }
                    if($userKinkao->user->Company->KinkaoStatus == 1)
                    {
                         $menu = $KinkaoAPI->getMenu();
                    
                        if(count($menu->menu) > 0)
                        {   
                            error_log('in 3');
                            $test = new kiaCarousel();

                            $client = new LINEBotTiny($channelAccessToken, $channelSecret);
                            $test->foodMenu2($userKinkao->user->LUID, $menu, $language, $userKinkao->user->Name, $userKinkao->user->Company->PriceLimit, $userKinkao->user->Company->ShowPrice);
                            $client->pushMessage($test);
                        }
                    }
                  
                    

                   
                    // $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
                    // $c = new kiaCarousel();

                    // $c->foodMenu2($userKinkao->user->LUID, $nonKinkaoMenu, $language, $userKinkao->user->Name);
                    // $client->pushMessage($c);

                    // $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
                    // $kc = new kiaCarousel();

                    // $kc->foodMenu2($userKinkao->user->LUID, $nonKinkaoMenu2, $language, $userKinkao->user->Name);
                    // $client->pushMessage($kc);

                    // $menu = $KinkaoAPI->getMenu();
                    // $test = new kiaCarousel();

                    // $test->foodMenu($event['replyToken'], $menu, $language, $userKinkao->user->Name);
                    // $client->replyMessage($test);
                    
                    break;
                }
                else if($message['text'] == 'Help')
                {
                    if($language == "EN")
                    {
                       $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => 'Type “Lunch" to see today’s menu and “Info" to view/modify your information. Type "credit" to see your credit'
                                )
                            )
                        ));
                    }
                    else{
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "พิมพ์ “Lunch” เพื่อดูเมนูของวันนี้ หรือ พิมพ์ “info” เพื่อดู/แก้ไขข้อมูลของคุณ"
                                )
                            )
                        ));
                    }
                    break;
                }
                else if($message['text'] == 'Kia')
                {
                    $userList = $KinkaoAPI->userList();
                    $nonKinkaoMenu = $KinkaoAPI->getRestaurantMenu();
                    $nonKinkaoMenu2 = $KinkaoAPI->getRestaurantMenu2();
                     $menu = $KinkaoAPI->getMenu();
                    for($i =0; $i < count($userList); $i++)
                    {
                        if($userList[$i]->Company->id == 26 || $userList[$i]->Company->id == 15)
                        {
                            if($userList[$i]->Company->Locked == false)
                            {
                                $isTodayLunch = false;
                                $LunchDay = date('l');
                                error_log($LunchDay);
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
                                
                                if($isTodayLunch == true )
                                {
                                    

                                    if(count($nonKinkaoMenu->menu) > 0)
                                    {
                                        error_log('in 1');
                                        $c = new kiaCarousel();
                                        $client = new LINEBotTiny($channelAccessToken, $channelSecret);
                                        $c->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu, $language, $userList[$i]->Name);
                                        $client->pushMessage($c);
                                    }
                                    
                                    if(count($nonKinkaoMenu2->menu) > 0)
                                    {
                                        error_log('in 2');
                                        $kc = new kiaCarousel();
                                        $client = new LINEBotTiny($channelAccessToken, $channelSecret);
                                        $kc->foodMenu2($userList[$i]->LUID, $nonKinkaoMenu2, $language, $userList[$i]->Name);
                                        $client->pushMessage($kc);
                                    }

                                
                                    if(count($menu->menu) > 0)
                                    {   
                                        error_log('in 3');
                                        $test = new kiaCarousel();

                                        $client = new LINEBotTiny($channelAccessToken, $channelSecret);
                                        $test->foodMenu2($userList[$i]->LUID, $menu, $language, $userList[$i]->Name);
                                        error_log(json_encode($test));
                                        $client->pushMessage($test);
                                    }
                                }
                            }
                        }
                        
                            
 
                        // $test->foodMenu2($userList[$i]->LUID, $menu, $language);
                       
                        // $client->pushMessage($test);

                        
                    }
                    break;
                }
                else 
                {
                    $client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => 'Type info to see your information or help for a list of command'
                            )
                        )
                    ));
                    break;
                }

            }
            else
            {
                $client->replyMessage(array(
                'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                            'type' => 'text',
                            'text' => 'you type is sticker and the text is'.$message['text']
                        )
                    )
                ));
                break;
            }
        }
        else if($event['type']=='postback')
        {
            $language = $userKinkao->user->Language;
            $message = $event['postback'];
            $postBackHandler = new postBackHandler();
            $dataRequest = $postBackHandler->init($message['data']);
            error_log('data request: '.json_encode($dataRequest));

            if($dataRequest['action'] =='edit')
            {
                $KinkaoAPI->startupdate($LUID);
                 if($language == "EN")
                    {
                    
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "What is your name?"
                                )
                            )
                        ));
                    }
                    else{
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "คุณชื่ออะไร?"
                                )
                            )
                        ));
                    }
                    break;
            }
            else if($dataRequest['action'] == "PushBuilding")
            {
                
                
             
                $userList = $KinkaoAPI->CompanyOrderList($dataRequest['id']);
                $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "Message has been push out"
                                )
                            )
                        ));
                error_log(json_encode($dataRequest['id']));
                
                for($i = 0; $i < count($userList->user); $i++)
                {
                    

                    
                    if(isset($userList->user[$i]->Owner->Language))
                    {
                        if( $userList->user[$i]->Owner->Language == "TH")
                        {
                            error_log(" push user".json_encode($userList->user[$i]));
                            $client->pushMessage(array(
                                'to' => $userList->user[$i]->LUID,
                                'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => $userList->user[$i]->CompanyId->Arrive_TH
                                        )
                                    )
                                )
                            );
                            
                        }
                        else
                        {
                            $client->pushMessage(array(
                                'to' => $userList->user[$i]->LUID,
                                'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => $userList->user[$i]->CompanyId->Arrive
                                            
                                        )
                                    )
                                )
                            );
                            
                        }   
                    }
                }
                break;   
            }
            else if($dataRequest['action']== "rate")
            {

                $KinkaoAPI->RateFood($LUID, $dataRequest['orderId'], $dataRequest['id'], $dataRequest['rate']);
                if($language == "EN")
                {
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "Thank you for your feedback"
                                )
                            )
                        ));
                }
                else{
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "Thank you for your feedback"
                                )
                            )
                        ));
                }
                  
            }
            else if($dataRequest['action']== "inquiry")
            {

              
                if($language == "EN")
                {
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "Thank you for your interest we will contact you within 24 hours"
                                )
                            )
                        ));
                }
                else{
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "Thank you for your interest we will contact you within 24 hours"
                                )
                            )
                        ));
                }
                  
            }
            else if($dataRequest['action']== "order")
            {
                 $isTodayLunch = false;
                 date_default_timezone_set("Asia/Bangkok");
                 $kdate = date("h:i:sa");
                 error_log($kdate);
                $LunchDay = date('l');
                error_log($LunchDay);
                error_log($userKinkao->user->Name);
                if($LunchDay == 'Monday')
                {
                    if($userKinkao->user->Company->Monday == true)
                    {
                        $isTodayLunch = true;
                    }
                }
                else if($LunchDay == 'Tuesday')
                {
                    if($userKinkao->user->Company->Tuesday == true)
                    {
                        $isTodayLunch = true;
                    }
                }
                else if($LunchDay == 'Wednesday')
                {
                    error_log($userKinkao->user->Company->Wednesday);
                    if($userKinkao->user->Company->Wednesday == true)
                    {
                        error_log($userKinkao->user->Company->Wednesday);
                        $isTodayLunch = true;
                    }
                }
                else if($LunchDay == 'Thursday')
                {
                    if($userKinkao->user->Company->Thursday == true)
                    {
                        $isTodayLunch = true;
                    }
                }
                else if($LunchDay == 'Friday')
                {
                    if($userKinkao->user->Company->Friday == true)
                    {
                        $isTodayLunch = true;
                    }
                }
                else if($LunchDay == 'Saturday')
                {
                    if($userKinkao->user->Company->Monday == true)
                    {
                        $isTodayLunch = true;
                    }
                }
                else if($LunchDay == 'Sunday')
                {
                    if($userKinkao->user->Company->Monday == true)
                    {
                        $isTodayLunch = true;
                    }
                }
                // if($isTodayLunch == true )
                // {
                    $menu = $KinkaoAPI->createOrder($LUID, $dataRequest['id']);
                    if($menu->msgcode == "0x0001")
                    {
                        $price = 0;
                        $credit = 0;
                        $personalcredit = $userKinkao->user->PersonalCredit;
                        if($userKinkao->user->Credit > $menu->order->Food->Price)
                        {
                            $price = 0;
                            $credit = $userKinkao->user->Credit - $menu->order->Food->Price;
                        }else if($userKinkao->user->Credit == 0){
                            
                            $price = $menu->order->Food->Price;
                            $credit = 0;
                        }else{
                            $price = $menu->order->Food->Price - $userKinkao->user->Credit;
                            $credit = 0;
                        }
                        if($userKinkao->user->PersonalCredit > $price && $price != 0)
                        {
                            
                            $personalcredit = $userKinkao->user->PersonalCredit - $price;
                            $price = 0;
                        }
                        else if($userKinkao->user->PersonalCredit != 0 && $price != 0)
                        {
                            $personalcredit = 0;
                            $price = $price - $userKinkao->user->PersonalCredit;
                        }
                        if($userKinkao->user->Company->Locked == 0)
                        {
                            if($userKinkao->user->Company->PN_Batch == 5)
                            {
                                if($language == "EN")
                                {   
                                    $client->replyMessage(array(
                                    'replyToken' => $event['replyToken'],
                                        'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => 'Today you have chosen *'.$menu->order->Type.'*.  You will receive your meal by 7PM. If you would like to cancel call  087-518-6178 before 10am. Thanks for your order'
                                            )
                                        )
                                    ));
                                }
                                else{
                                    $client->replyMessage(array(
                                    'replyToken' => $event['replyToken'],
                                        'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => 'วันนี้คุณได้เลือก *'.$menu->order->Type.'* คุณจะต้องจ่าย ฿ '.$price.' และมีเครดิตเหลือ ฿'.$credit.' และมีเครดิตส่วนตัวเหลือ ฿'.$personalcredit.' คุณจะได้รับอาหารเที่ยงก่อน 18:00น. หากคุณต้องการยกเลิก กรุณาติดต่อ 087-518-6178 ก่อน 10.00น. ขอบคุณค่ะ'
                                            )
                                        )
                                    ));
                                }
                            } else {
                                if($language == "EN")
                                {
                                    $client->replyMessage(array(
                                    'replyToken' => $event['replyToken'],
                                        'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => 'Today you have chosen *'.$menu->order->Type.'*. You will pay ฿ '.$price.' and you have ฿'.$credit.' credit and  ฿'.$personalcredit.' Personal credit left. You will receive your meal by noon. If you would like to cancel call  087-518-6178 before 10am. Thanks for your order'
                                            )
                                        )
                                    ));
                                }
                                else{
                                    $client->replyMessage(array(
                                    'replyToken' => $event['replyToken'],
                                        'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => 'วันนี้คุณได้เลือก *'.$menu->order->Type.'* คุณจะต้องจ่าย ฿ '.$price.' และมีเครดิตเหลือ ฿'.$credit.' และมีเครดิตส่วนตัวเหลือ ฿'.$personalcredit.' คุณจะได้รับอาหารเที่ยงก่อน 12:00น. หากคุณต้องการยกเลิก กรุณาติดต่อ 087-518-6178 ก่อน 10.00น. ขอบคุณค่ะ'
                                            )
                                        )
                                    ));
                                }

                            }
                            
                            
                        } else {
                            if($language == "EN")
                            {
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'Sorry. Your company is no longer active in our system. Please contact your HR.'
                                        )
                                    )
                                ));
                            }
                            else{
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'ขอโทษค่ะ ระบบไม่สามารถรับออเดอร์จากบริษัทของคุณ กรุณาติดต่อแผนก HR ของคุณ'
                                        )
                                    )
                                ));
                            }
                        }
                    
                        break;
                    }
                    else if($menu->msgcode == "0x0004")
                    {
                        $price = 0;
                        $credit = 0;
                        $personalcredit = $userKinkao->user->PersonalCredit;
                        if($userKinkao->user->Credit > $menu->order->Food->Price)
                        {
                            $price = 0;
                            $credit = $userKinkao->user->Credit - $menu->order->Food->Price;
                        }else if($userKinkao->user->Credit == 0){
                            
                            $price = $menu->order->Food->Price;
                            $credit = 0;
                        }else{
                            $price = $menu->order->Food->Price - $userKinkao->user->Credit;
                            $credit = 0;
                        }
                        if($userKinkao->user->PersonalCredit > $price && $price != 0)
                        {
                            
                            $personalcredit = $userKinkao->user->PersonalCredit - $price;
                            $price = 0;
                        }
                        else if($userKinkao->user->PersonalCredit != 0 && $price != 0)
                        {
                            $personalcredit = 0;
                            $price = $price - $userKinkao->user->PersonalCredit;
                        }
                        if($userKinkao->user->Company->PN_Batch == 5){
                            if($language == "EN")
                                {   
                                    $client->replyMessage(array(
                                    'replyToken' => $event['replyToken'],
                                        'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => 'Today you have chosen *'.$menu->order->Type.'*.  You will receive your meal by 7PM. If you would like to cancel call  087-518-6178 before 10am. Thanks for your order'
                                            )
                                        )
                                    ));
                                }
                                else{
                                    $client->replyMessage(array(
                                    'replyToken' => $event['replyToken'],
                                        'messages' => array(
                                            array(
                                                'type' => 'text',
                                                'text' => 'วันนี้คุณได้เลือกเมนู *'.$menu->order->Type.'*. อาหารจะส่งถึงออฟฟิศภายใน 19.00น. หากคุณต้องการยกเลิกกรุณาโทร 087-518-6178 ก่อน 10.00น. ขอบคุณค่ะ'
                                            )
                                        )
                                    ));
                                }
                        }
                        else {
                            if($language == "EN")
                            {
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'Tomorrow you have chosen *'.$menu->order->Type.'*. You will pay ฿ '.$price.' and you have ฿'.$credit.' credit and  ฿'.$personalcredit.' Personal credit left. You will receive your meal by noon tomorrow. If you would like to cancel call  087-518-6178 before 10am. Thanks for your order'
                                        )
                                    )
                                ));
                            }
                            else{
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'พรุ่งนี้คุณได้เลือก *'.$menu->order->Type.'* คุณจะต้องจ่าย ฿ '.$price.' และมีเครดิตเหลือ ฿'.$credit.' และมีเครดิตส่วนตัวเหลือ ฿'.$personalcredit.' คุณจะได้รับอาหารเที่ยงก่อน 12:00น. ในวันพรุ่งนี้ หากคุณต้องการยกเลิก กรุณาติดต่อ 087-518-6178 ก่อน 10.00น. ขอบคุณค่ะ'
                                        )
                                    )
                                ));
                            }

                        }
                        
                    }
                    else if($menu->msgcode == "0x0003")
                    {
                            if($language == "EN")
                            {
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'Sorry, we sold out this menu for today. You can click on another menu to change your order.'
                                        )
                                    )
                                ));
                            }
                            else{
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'ขอโทษค่ะ วันนี้เมนูที่คุณได้เลือกหมดแล้ว กรุณาเลือกเมนูอื่น เพื่อสั่งอาหาร'
                                        )
                                    )
                                ));
                            }
                    }
                    else if($menu->msgcode == "0x0005")
                    {
                            if($language == "EN")
                            {
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'Sorry, Kinkao is not at your company service today'
                                        )
                                    )
                                ));
                            }
                            else{
                                $client->replyMessage(array(
                                'replyToken' => $event['replyToken'],
                                    'messages' => array(
                                        array(
                                            'type' => 'text',
                                            'text' => 'ขอโทษค่ะ บริษัทของคุณไม่ได้ใช้บริการ Kinkao ในวันนี้'
                                        )
                                    )
                                ));
                            }
                    }
                    else if($menu->msgcode == "0x0002")
                    {
                        if($language == "EN")
                        {
                            $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                                'messages' => array(
                                    array(
                                        'type' => 'text',
                                        'text' => "Sorry ".$userKinkao->user->Name.", it's too late for today! We send new menu from Mon - Fri at 2.00pm, please click YES before 10am."
                                    )
                                )
                            ));
                            break;
                        }else{
                            $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                                'messages' => array(
                                    array(
                                        'type' => 'text',
                                        'text' => "ขอโทษค่ะ คุณ".$userKinkao->user->Name." วันนี้ออเดอร์ได้ปิดแล้ว คุณจะได้รับเมนูใหม่ทุกวันจันทร์ - ศุกร์ เวลา 14.00น. คุณสามารถคลิก YES เพื่อสั่งอาหารได้ก่อน 10.00น. นะคะ"
                                    )
                                )
                            ));
                            break;
                        }
                    }
                    else if($menu->msgcode = "0x0008")
                    {
                        if($language == "EN")
                        {
                            $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                                'messages' => array(
                                    array(
                                        'type' => 'text',
                                        'text' => "Sorry ".$userKinkao->user->Name.", You can't order from the previous menu"
                                    )
                                )
                            ));
                            break;
                        }else{
                            $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                                'messages' => array(
                                    array(
                                        'type' => 'text',
                                        'text' => "ขอโทษค่ะ ".$userKinkao->user->Name." คุณไม่สามารถสั่งจากเมนูที่ผ่านมาแล้ว"
                                    )
                                )
                            ));
                            break;
                        }
                    }
                  
               // } // end of if is today lunch
                
                
            }

            else if($dataRequest['action']== "building")
            {
                $building = $KinkaoAPI->getBuilding();
                $buildingSingle = array();
                $buildingList = array();
                $companyCount = 0;

                 $companyCount = count($building->company)-1;
                for($i = 0; $i < count($building->company); $i++)
                {
                    $modu =0;
                    $modu = $i % 14;
                    error_log($i.' % 15 = '.$modu);
                   
                    error_log(' -1 counter'.$companyCount);
                    if($i == 0)
                    {
                        array_push($buildingSingle, $building->company[$i]);

                    }
                    else if($i == $companyCount)
                    {
                        array_push($buildingSingle, $building->company[$i]);
                        array_push($buildingList, $buildingSingle);
                        $buildingSingle = array();
                    }
                    else if( $modu != 0)
                    {
                        array_push($buildingSingle, $building->company[$i]);
                    }
                    else if( $modu == 0){
                        array_push($buildingSingle, $building->company[$i]);
                        array_push($buildingList, $buildingSingle);
                        $buildingSingle = array();
                    }
                    
                    

                }
                
                for($i =0; $i <count($buildingList); $i++)
                {
                    $building->company = $buildingList[$i];
                
                    $model = (object) ['replyToken'=> $event['replyToken'], 'building' => $building];
                    
                    $kinkao = new kiaCarousel();
                    $kinkao->pushbuildinglist($model, $language, $userKinkao->user->LUID);
                    $client->pushMessage($kinkao);
                }
               
                break;
            }
            else if($dataRequest['action'] == "setBuilding")
            {
                $building = $KinkaoAPI->updateProfileCompany($LUID, $dataRequest['id']);
                if($language == "EN")
                {
                    $client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => 'Saved! Your Company is '.$building->user->Company->Name.'. Type info to see your information or help for a list of command'
                            )
                        )
                    ));
                }
                else{
                    $client->replyMessage(array(
                    'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => 'บันทึกเรียบร้อยแล้ว บริษัทของคุณคือ '.$building->user->Company->Name.'.  พิมพ์ ‘info‘ เพื่อดูหรือแก้ไขข้อมูลอื่นๆ'
                            )
                        )
                    ));
                }
                
                break;   
            }
            else if($dataRequest['action']== "Language")
            {
                $model = (object) ['replyToken'=> $event['replyToken']];

                $kinkao = new kiaCarousel();
                $kinkao->StartLanguage($model, $language);
                $client->replyMessage($kinkao);
                break;
            }
            else if($dataRequest['action']== "setLanguage")
            {
                $message = $event['message'];
                $KinkaoAPI->updateProfileLanguage($LUID, $dataRequest['id']);
                $client->replyMessage(array(
                'replyToken' => $event['replyToken'],
                    'messages' => array(
                        array(
                            'type' => 'text',
                            'text' => 'Your Prefered Language is '.$dataRequest['id']
                        )
                    )
                ));
                break;
            }
        }
        else
        {
              error_log("Unsupported event type: " . $event['type']);
                break;
        }
    }
    else if($userKinkao->response == true && $userKinkao->user->Step != 0)
    {
        $language = $userKinkao->user->Language;
        if($event['type']=='message')
        {
            if($userKinkao->user->Step == 1)
            {
                
                
                $message = $event['message'];
                 $KinkaoAPI->updateProfile($LUID, $message['text'], "text");
                if($message['type']=='text')
                {
                    if($language == "EN")
                    {
                    
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "What is your name?"
                                )
                            )
                        ));
                    }
                    else{
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "คุณชื่ออะไร?"
                                )
                            )
                        ));
                    }
                    break;
                }
            }

            else if($userKinkao->user->Step == 2)
            {
                
                
                $message = $event['message'];
                $KinkaoAPI->updateProfile($LUID, $message['text'], "text");

                if($message['type']=='text')
                {
                    if($language == "EN")
                    {
                   
                        $client->replyMessage(array(
                        f
                        ));
                    }
                    else{
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "อีเมล์ของคุณคืออะไร? "
                                )
                            )
                        ));
                    }
                    break;
                }
            }
            else if($userKinkao->user->Step == 3)
            {
                
                $message = $event['message'];
                $KinkaoAPI->updateProfile($LUID, $message['text'], "text");
                if($message['type']=='text')
                {
                    if( $language == "EN")
                    {
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "Last question, what’s your phone number?"
                                )
                            )
                        ));
                    }
                    else{
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "คำถามสุดท้าย เบอร์โทรศัพท์ของคุณคืออะไร?"
                                )
                            )
                        ));
                    }
                    break;
                }
            }
            else if($userKinkao->user->Step == 4)
            {
                $message = $event['message'];
                $KinkaoAPI->updateProfile($LUID, $message['text'], "text");
                if($message['type']=='text')
                {
                    if($language == "EN")
                    {
                    
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => 'Your profile is now complete! Type “Lunch" to see today’s menu and “Info" to view/modify your information'
                                )
                            )
                        ));
                    }
                    else{
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => 'ข้อมูลของคุณได้ถูกบันทึกเรียบร้อยแล้ว พิมพ์ “Lunch” เพื่อดูเมนูของวันนี้ หรือ พิมพ์ “info” เพื่อดู/แก้ไขข้อมูลของคุณ'
                                )
                            )
                        ));   
                    }
                    break;
                }
            }
            else {
                $model = (object) ['replyToken'=> $event['replyToken']];

                $kinkao = new kiaCarousel();
                $kinkao->StartLanguage($model, $language);
                $client->replyMessage($kinkao);
            }
        }
        else if($event['type']=='postback')
        {
            $message = $event['postback'];
            $postBackHandler = new postBackHandler();
            $dataRequest = $postBackHandler->init($message['data']);
            error_log('data request: '.json_encode($dataRequest));

            if($dataRequest['action'] == "setBuilding")
            {
                $KinkaoAPI->updateProfile($LUID, $dataRequest['id'], "setBuilding");
             
                    if($language == "EN")
                    {
                    
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "What is your name?"
                                )
                            )
                        ));
                    }
                    else{
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => "คุณชื่ออะไร?"
                                )
                            )
                        ));
                    }
                break;   
            }

            else if($dataRequest['action']== "setLanguage")
            {
                
                $KinkaoAPI->updateProfile($LUID, $dataRequest['id'], "setLanguage");
                // $building = $KinkaoAPI->getBuilding();
                // $model = (object) ['replyToken'=> $event['replyToken'], 'building' => $building];

                // $kinkao = new kiaCarousel();
                // $kinkao->buildinglist($model, $language);
                // $client->replyMessage($kinkao);


                $building = $KinkaoAPI->getBuilding();
                $buildingSingle = array();
                $buildingList = array();
                $companyCount = 0;

                 $companyCount = count($building->company)-1;
                for($i = 0; $i < count($building->company); $i++)
                {
                    $modu =0;
                    $modu = $i % 14;
                    error_log($i.' % 15 = '.$modu);
                   
                    error_log(' -1 counter'.$companyCount);
                    if($i == 0)
                    {
                        array_push($buildingSingle, $building->company[$i]);

                    }
                    else if($i == $companyCount)
                    {
                        array_push($buildingSingle, $building->company[$i]);
                        array_push($buildingList, $buildingSingle);
                        $buildingSingle = array();
                    }
                    else if( $modu != 0)
                    {
                        array_push($buildingSingle, $building->company[$i]);
                    }
                    else if( $modu == 0){
                        array_push($buildingSingle, $building->company[$i]);
                        array_push($buildingList, $buildingSingle);
                        $buildingSingle = array();
                    }
                    
                    

                }
                
                for($i =0; $i <count($buildingList); $i++)
                {
                    $building->company = $buildingList[$i];
                
                    $model = (object) ['replyToken'=> $event['replyToken'], 'building' => $building];
                    
                    $kinkao = new kiaCarousel();
                    $kinkao->pushbuildinglist($model, $language, $userKinkao->user->LUID);
                    $client->pushMessage($kinkao);
                }
                break;
            }
        }
         
     
    }
    else
    {
        $message = $event['message'];
        if($message['type']=='text')
        {

         //   $KinkaoAPI->createUser($LUID);
            $model = (object) ['replyToken'=> $event['replyToken'], 'LUID' => $LUID];
                        
            $kinkao = new kiaCarousel();
            $kinkao->registrationLine($model, $language);

            // $model = (object) ['replyToken'=> $event['replyToken']];
            // $kinkao = new kiaCarousel();
            // $kinkao->StartLanguage($model, $language);
            $client->replyMessage($kinkao);
            
/*            $client->replyMessage(array(
            'replyToken' => $event['replyToken'],
                'messages' => array(
                    array(
                        'type' => 'text',
                        'text' => "Hello there! Let start to get to know each other first. \nWhat is your name?"
                    )
                )
            ));*/
            break;
        }

    }    
};
