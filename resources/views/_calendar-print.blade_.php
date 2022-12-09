<?php $months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
$currentMonthName = $months[$get_month - 1];
?>
<!-- <div class="header">
    <div class="left_part">
        <div class="menu_text">
            <h2>Menu Calendar Report</h2>
            <p>{{$site_name->name}}</p>
        </div>
        <ul class="recipe_type">
            <li>
                <span>Age Group</span>
                <p>{{$age_group->name}}</p>
            </li>
            <li>
                <span>Days</span>
                <p>{{$day_data->name}}</p>
            </li>
        </ul>
    </div>
    <div class="right_part">
        <img style="max-width:100%;" src="{{ asset('images/pdf-logo.png') }}" alt="">
    </div>
</div> -->

<div class="table_section">
    <div class="month_year">
        <div class="month_name">Menu: {{$currentMonthName}}, {{$get_year}}</div>
        <p>
            <b style="float: right;">{{ $site_name->name }}, {{ $age_group->name }}</b><br/>
        * Variety of milk is offered with lunch each day
        </p>
    </div>
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <!-- <th>&nbsp;</th> -->
                <th style="width: 12%;">Sunday</th>
                <th style="width: 12%;">Monday</th>
                <th style="width: 12%;">Tuesday</th>
                <th  style="width: 12%;">Wednesday</th>
                <th  style="width: 12%;">Thursday</th>
                <th  style="width: 12%;">Friday</th>
                <th style="width: 12%;">Saturday</th>
               
            </tr>
        </thead>
        <tbody>
       
        @foreach($calender_days['weeks'] as $key=>$weeks)
					<?php 
							// $order = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI','SAT');
							// usort($weeks['days'], function ($a, $b) use ($order) {
							// 		$pos_a = array_search($a['day'], $order);
							// 		$pos_b = array_search($b['day'], $order);
							// 		return $pos_a - $pos_b;
							// });
							 $keys = $weeks['days'];
                           
                            
					?>
            <tr> 
              @foreach($keys as $k=>$day)
              
                <td style="vertical-align: top;"> 
									<p class="pt-1 pb-1 " style="float: left; margin-top: -10px;"><b>{{ explode('-', $day['date'])[1] }}</b></p> 
                  @if($calendar_data)
                    @foreach($calendar_data as $data)
                         @if($data->week_number == $key)
                            @foreach($data->menu_cycle->menuCycleDays as $i=>$menuDay)
                                @if($menuDay && $menuDay['day_of_week_number'] == $k )
                                    @if($menuDay->options && $menuDay->options != '')
                                       @foreach($menuDay->options as $option)
																			                                        
                                        <p><b>{{$option->name}}</b></p>
                                        @if ($loop->first)
                                        @foreach($option->menuCycleDayOptionComponents as $optionC)
                                            @if(!$optionC->is_exclude_from_printable_calendar &&  $optionC->recipe && $optionC->recipe->category != 'Milk')
                                                <p>{{ (	$optionC->recipe->simplified_name && $optionC->recipe->simplified_name != '')?$optionC->recipe->simplified_name: $optionC->recipe->name}}</p>
                                            @endif
                                        @endforeach
                                        @endif

                                       @endforeach
                                    @endif
                                @endif
                            @endforeach
                        @endif 
                    @endforeach 
                  @endif
                </td>
              @endforeach         
            </tr>
            @endforeach
        </tbody>
    </table>
    <div><p class="pt-1 pb-1 " style="float: right;"><b> An equal opportunity employer</b></p></div>
</div>





<style>
    * {
        -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
        color-adjust: exact !important;                 /*Firefox*/
    }
    body{
        font-family: 'Lato', sans-serif !important;
        padding: 20px;
    }
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 30px 0px;
        width: 100%;
    }
    .left_part {
        display: flex;
    }
    .menu_text {
        margin-right: 40px;
    }
    .menu_text h2 {
        margin: 0px 0px 6px;
        display: block;
        font-size: 24px;
        font-weight: 700;
        color: #132d56;
        line-height: normal;
    }
    .menu_text p{
        margin: 0px 0px 0px;
        text-transform: uppercase;
        color: #919191;
        font-size: 18px;
        line-height: normal;
        font-weight: 700;
    }
    ul.recipe_type {
        padding: 0px;
        margin: 0px;
        display: flex;
        align-items: stretch;
    }
    ul.recipe_type li {
        min-width: 160px;
        display: inline-flex;
        border-left: 2px solid #e5e5e5;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 15px 10px;
    }
    ul.recipe_type li p {
        margin: 0px;
        color: #132d56;
        font-size: 18px;
        font-weight: 700;
    }
    ul.recipe_type li span {
        display: block;
        margin: 0px 0px 2px;
        color: #39b54a;
        font-size: 16px;
        font-weight: 500;
        text-transform: uppercase;
    }
    .month_year {
        background: rgba(30, 67, 127);
        border-radius: 15px 15px 0px 0px;
        padding: 16px 12px 10px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        width: 100%;
        box-sizing: border-box;
    }
    .month_name {
        color: #fff;
        font-size: 24px;
        font-weight: 700;
    }
    .month_year p {
        font-size: 16px;
        color: #fff;
        margin: 0px;
        font-weight: 300 !important;
    }
    table.table {
        width: 100%;
        border: none;
    }
    table.table thead {
        background: #132d56;
    }
    table.table thead th {
        color: #fff;
        vertical-align: bottom;
        padding: 20px 6px 10px;
        border-right: 2px solid #233b61;
        font-size: 12px;
    }
    table.table thead th:last-child{
        border-right: none;
    }
    table.table tr.grey_bar td {
        background: #e8e8e8;
        border-right: 2px solid #d9d9d9;
        border-bottom-color: #d9d9d9;
        padding: 7px 5px 6px 10px;
        font-size: 14px;
        color: #454545;
        font-weight: 600;
        text-align: left;
    }
    table.table tr td {
        font-size: 14px;
        line-height: normal;
        color: #454545;
        text-align: center;
        padding: 20px 6px;
        border-style: solid;
        border-color: #eeeeee;
        border-width: 2px 2px 2px 0px;
        border-bottom-color: #cecece;
    }
    table.table tr td:first-child{
        border-left: 2px solid #eeeeee;
    }
    table.table tr td p{
        margin: 0px;
    }
    table.table tr td p + p{
        margin-top: 7px;
    }
    @page {
      size: auto;
      margin: 0;
    }
      
</style>