<?php

function dd($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function  paginator($page, $pages, $module) {

    $html = '';

    if($pages < 2) {
        return $html;
    }

    $html = '<nav aria-label="Page navigation example">';
    $html .= '<ul class="pagination">';

        $start = $page - 2;

        if ($start < 1) {
            $start = 1;
        }



        if($pages <= 5) {

            $end = $pages+1;

        } else {
            $end = $start + 5;

            if ($end > $pages) {
                $diff = $end - $pages;
                $end = $pages;
                $start = $start - $diff;
            }
        }


        // switch
        //        switch($page)
        //        {
        //            case 1:
        //                $start = $page;
        //                $end = $page + 4;
        //                break;
        //
        //            case 2:
        //                $start = $page-1;
        //                $end = $page + 3;
        //                break;
        //
        //            case $pages:
        //                $start = $page-4;
        //                $end = $page;
        //                break;
        //
        //            case $pages-1:
        //                $start = $page-3;
        //                $end = $pages;
        //                break;
        //
        //            default:
        //                $start = $page - 2;
        //                $end = $page + 2;
        //                break;
        //        }


        // if($end > $pages) {
        ///     $end = $pages;
        // }


        for ($i = $start; $i <= $end; $i++) {
            $active = ($i == $page) ? ' active' : '';

            $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="?module='.$module.'&page=' . $i . '">' . $i . '</a></li>';

        }


        $html .= '</ul>';
    $html .= '</nav>';

    return $html;


}


function  paginator_monia($page, $pages, $step, $module) {

    $html = '';

    $html = '<nav aria-label="Page navigation example">';
    $html .= '<ul class="pagination">';

   // $step=2;
    $start = $page - $step;
    $end = $page + $step;
    $diff=0;

    //na poczatek

    if ($start < 1) {
        $diff=1+(-$start);
        $start = 1;
        $end= $end+$diff;
        //jezeli nowe end wyszedl poza zakres ...
          if($end>$pages){
              $end=$pages;
          }
    }


    // na koncu
    if ($end >$pages) {
        $diff=$end-$pages;
        $end=$pages;
        $start=$start-$diff;
        echo 'diff w if =' . $diff;
        //jezeli nowe start wyszedl poza zakres ...
         if($start < 1) {
             $start = 1;
         }
    }

   // echo 'diff=' . $diff;
   // echo 'start=' .$start;
   // echo 'end=' .$end;

    for ($i = $start; $i <= $end; $i++) {
        $active = ($i == $page) ? ' active' : '';

        $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="?module='.$module.'&page=' . $i . '">' . $i . '</a></li>';

    }


    $html .= '</ul>';
    $html .= '</nav>';

    return $html;


}