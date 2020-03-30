<?php
    class FormModel
    {
        // paging
        public $PageSize;
        public $StartRow;
        public $Search;
        public $SortOrder;
        public $RowCount;
        public $PageCount;
        public $EndRow;

        // form name
        public $FormName;

        // navigation
        public $UrlRefer;

        // filter
        public $SelectedIndexRow;

        // error
        public $ErrorName;
        public $ErrorDescription;

        // url
        public $url;
        public $urlBase;

        // return save
        public $status;
    }
?>