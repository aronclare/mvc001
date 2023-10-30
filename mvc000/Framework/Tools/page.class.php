<?php


namespace Framework\Tools;


class page{

    public static function show($count,$page,$pagesize,$query_str){




            $pagecount = ceil($count / $pagesize);


            //计算上一页的页码
            $prev = $page > 1 ? $page - 1 : 1;
            //计算下一页的页码

            $next = $page < $pagecount ? $page + 1 : $pagecount;
            $html = '';
            $html .= '<a href="'.$query_str.'&page='.$prev .'">上一页</a>';
            for ($i = 1; $i <= $pagecount; $i++) {
                $html .= '<a href="'.$query_str.'&page=' . $i . '">' . $i . '</a> ';
            }
            $html .= '<a href="'.$query_str.'&page=' . $next . '">下一页</a>';
            return $html;
        }
    public static function show_plus($count,$page,$pagesize,$url){
        //计算出总页数
        $pagecount=ceil($count/$pagesize);
        //计算上一页的页码
        $prev= $page>1 ? $page-1 : 1;
        //计算下一页的页码
        $next= $page<$pagecount ? $page+1 : $pagecount;
        //生成所有页码的下拉列表
        $select='<select onchange="location.href=\''.$url.'&page=\'+this.value;">';
        for($i=1;$i<=$pagecount;$i++){
            //为下拉列表设置当前页的默认值
            if($page==$i){
                $select.='<option value="'.$i.'" selected="selected">'.$i.'</option>';
            }else{
                $select.='<option value="'.$i.'">'.$i.'</option>';
            }
        }
        $select.='</select>';

        $html=<<<abc
        <table id="page-table" cellspacing="0">
        <tbody>
            <tr>
                <td align="right" nowrap="true" style="background-color: rgb(255, 255, 255);">
                    <div id="turn-page">
            总计  <span id="totalRecords">{$count}</span>个记录分为 <span id="totalPages">
{$pagecount}</span>页当前第 <span id="pageCurrent">{$page}</span>
        页，每页 {$pagesize} 条数据
                        <span id="page-link">
                            <a href="{$url}&page=1">第一页</a>
                            <a href="{$url}&page={$prev}">上一页</a>
                            <a href="{$url}&page={$next}">下一页</a>
                            <a href="{$url}&page={$pagecount}">最末页</a>
                            {$select}
                        </span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
abc;
        return $html;
    }

}