<?php
    class URLClass
    {
        // Global Website Url
        private $GlobalWebsiteUrl = "http://localhost/CI/";
        private $GlobalAPIUrl = "http://api.kmn.kompas.com/newadvdev/";

        public function WorkstateUrl(){
            return $this->GlobalAPIUrl."Workstate/";
        } 

        public function BrandUrl(){
            return $this->GlobalAPIUrl."Brand/";
        } 
    }