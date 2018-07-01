<?php
    class splitPage {
        private $total; //total rows
        private $listRows; //the number of rows for each page
        private $limit;
        private $uri;
        private $pageNum; //total num of page
        private $config=array('header'=>"条记录", "prev"=>"《", "next"=>"》", "first"=>"首页", "last"=>"尾页");
        private $listNum=8;
       
        /**
         * $total
         * $listRows
         */
        public function __construct($total, $listRows){
            $this->total=$total;
            $this->listRows=$listRows;
            $this->uri=$this->getUri();
            $this->page = !empty($_GET["page"])? $_GET["page"]:1;
            $this->pageNum = ceil($this->total/$this->listRows);
            $this->limit=$this->setLimit();
        }

        private function setLimit(){

            return "Limit ". ($this->page-1) * ($this->listRows).", {$this->listRows}";
        }
        private function getUri(){
            $url = $_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"], '?')?'':"?");
            
            $parse = parse_url($url);

            if(isset($parse["query"])){
                //delete page in url
                parse_str($parse['query'], $params);
                unset($params["page"]);
                $url = $parse['path'].'?'.http_build_query($params);
            }
            
            return $url;
        }
        public function __get($args){
            if($args=="limit")
                return $this->limit;
            else
                return null;
        }

        private function first(){
        //    if($this->page==1)
        //        $html.="";
        //    else 
                $html = "<li><a href='{$this->uri}&page=1'>{$this->config["first"]}</a></li>";
            return $html;
        }

        private function prev(){
            if($this->page==1)
                $html ="";
            else 
                $html ="<li><a href='{$this->uri}&page=". ($this->page-1)."'>{$this->config["prev"]}</a></li>";
            return $html;
        }

        private function pageList(){
            $linkPage="";

            $inum=floor($this->listNum/2);

            for($i=$inum; $i>=1; $i--){
                $page=$this->page-$i;
                if($page < 1)
                    continue;
                $linkPage.="<li><a href='{$this->uri}&page={$page}'>{$page}</a></li>";
            }

            $linkPage.="<li class='active'><a class='theme-backcolor' href='#'>{$this->page}</a></li>";

            for($i=1; $i<$inum; $i++){

                $page=$this->page+$i;
                if($page <= $this->pageNum)
                    $linkPage.="<li><a href='{$this->uri}&page={$page}'>{$page}</a></li>";
                else {
                    break;
                }
            }

            return $linkPage;
        }

        private function next(){
            if($this->page==$this->pageNum)
                $html ="";
            else 
                $html ="<li><a href='{$this->uri}&page=". ($this->page+1)."'>{$this->config["next"]}</a></li>";
            return $html;
        }

        private function last(){
        //    if($this->page==$this->pageNum)
        //        $html.="";
        //    else 
                $html ="<li><a href='{$this->uri}&page=". ($this->pageNum)."'>{$this->config["last"]}</a></li>";
            return $html;
        }

        private function specificPage(){
            return " ";
        }

        function fpage(){
            $html = "<div class='row text-center'><ul class='pagination'>";
            $html .= $this->first();
            $html .= $this->prev();
            $html .= $this->pageList();
            $html .= $this->next();
            $html .= $this->last();
         //   $html .= "<li><a>共有($this->total){$this->config["header"]}</a></li>";
         //   $html .= "<li><a>{$this->page}/{$this->pageNum}页</a></li>";
            $html .= "</ul></div>";
            //$html .= $this->specificPage(); //for future development
            return $html;
        }
    }
?>