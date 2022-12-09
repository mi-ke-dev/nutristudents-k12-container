<?php
use Illuminate\Support\Facades\Storage;
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 
  <style>
    @page { margin: 10px 25px; }
     
    table.food_detail tr td{
      max-width: 30px;
      word-break: break-all;
    }
    table.food_detail tr td:nth-child(2){
      max-width: initial;
    }
    

    
  </style>
  
</head>
<body >


    <div style="padding:20px 0px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.2em; position: relative;">
<div class="hHide" style="background-color: white; "></div>

  <table cellpadding="0" cellspacing="0" style="width: 100%;  border:0; margin-bottom: 10px;">
    <tr valign="top">
      <td style="padding-right: 30px; width: 60%;">
        <p style="margin: 0 0 5px; padding: 0; font-weight: 700; color: #132d56; font-size: 18px;">Food Production Report</p>
        <p style="margin: 0 0 25px; padding: 0; font-weight: 700; color: #919191; font-size: 14px;">
        {{ $menuCycleDay->menuCycle->guideline->name }}</p>
        <!-- <p style="margin: 0 0 10px; padding: 0; font-weight: 700; color: #1e437f; font-size: 16px;">Menu Producon Record</p> -->

        <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; margin-bottom: 15px;">
          <tr>
            <td style="padding: 0; font-weight: 700; color: #1e437f; font-size: 12px; width: 10%;">SCHOOL/SITE:</td>
            <td style="width: 50%;border-bottom: 1px solid #6e6e6e;">&nbsp;{{ $siteName }}</td>
            <td style="padding: 0; font-weight: 700; color: #1e437f; font-size: 12px; width: 8%;">DAY/DATE:</td>
            <td style="width: 32%;border-bottom: 1px solid #6e6e6e;">&nbsp;{{ $curent_date }}</td>
          </tr>
        </table>

        <table cellpadding="0" cellspacing="0" style="border:0; margin-bottom: 15px;">
          <tr>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>Breakfast
            </td>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>Lunch
            </td>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>Afterschool Snack
            </td>
          </tr>
          <tr>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>SFSP
            </td>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>CACFP/At-Risk
            </td>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>Salad Bar
            </td>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>Other
            </td>
          </tr>
          <tr>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>Offer vs. Serve
            </td>
            <td style="font-size: 12px; padding-right: 30px; padding-bottom: 10px; color: #454545; font-weight: 700;">
              <span style="display: inline-block; width: 14px; height: 14px; border: 1px solid #000; vertical-align:text-bottom; margin-right: 7px;"></span>Serve-Only
            </td>
          </tr>
        </table>

        <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; margin-bottom: 15px;">
          <tr valign="top">
            <td style="padding: 0; font-weight: 700; color: #1e437f; font-size: 14px; width: 8%;">COMMENTS:</td>
            <td style="width: 90%;">
              <p style="width: 100%; border-bottom: 1px solid #6e6e6e; margin:0px; padding:0px; line-height:normal;">&nbsp;</p>
              <p style="width:100%; border-bottom: 1px solid #6e6e6e; margin:0px; padding:0px; line-height:normal;">&nbsp;</p>
            </td>
          </tr>
        </table>
      </td>
      <td style="width: 40%;">
        <table cellpadding="0" cellspacing="0" style="width: 100%; border:1px solid #ccc; margin-bottom: 15px;border-collapse: collapse;">
          <tr valign="top">
            <td style="width:100%">
              <p style="margin: 0; padding: 5px 10px; font-weight: 700; color: #fff; font-size: 12px; background-color: #1e437f;">Today’s Menu</p>
              <p style="margin: 0; padding: 10px; font-size: 11px; color: #454545; line-height: 1.2em; ">
              @foreach($menuCycleDay->menuCycleDayOptions as $menu)  
              <strong style="font-size: 12px;">{{$menu->name}} {{ ($menu->a_la_carte)?' - A LA CARTE':'' }}</strong><br>
              @if($loop->index == 0)
                @foreach($menu->menuCycleDayOptionComponents->sortBy('recipe.category_sort') as $comp)
                  @if($comp->recipe)
                  {{ $comp->recipe->show_name }} <br/>
                  @endif
                @endforeach
              @endif
              @endforeach

               
              </p>
            </td>
             <td style="border: 1px solid #ccc;">
              @if($firstOption && $firstOption->photo_store_path)
                <img src="{{Storage::url($firstOption->photo_store_path)}}" width="180" height="auto" alt="">
              @else
                <img src="{{ global_asset('images/recipe.jpg') }}" width="180" height="auto" alt="">
              @endif
            </td>
          </tr>
        </table>

         

        <table cellpadding="0" cellspacing="0" style="width: 100%; border:1px solid #ccc; margin-bottom: 15px;border-collapse: collapse;">
          <tr>
            <th style="padding: 5px 5px; font-weight: 700; color: #fff; font-size: 12px; background-color: #1e437f; text-align: left;">&nbsp;</th>
            <th style="padding: 5px 5px; font-weight: 700; color: #fff; font-size: 12px; background-color: #1e437f; text-align: center;">Meals Planned</th>
            <th style="padding: 5px 5px; font-weight: 700; color: #fff; font-size: 12px; background-color: #1e437f; text-align: center;">Meals Served</th>
          </tr>
          <tr>
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: left;">Student Meals</td>
            
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center;">{{ $showHeadCount }}</td>
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center;">&nbsp;</td>
          </tr>
          <tr style="background-color: #f5f5f5;">
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: left;">Non-Reimb. Meals</td>
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center;">&nbsp;</td>
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center;">&nbsp;</td>
          </tr>
          <tr>
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: left;">Total Meals</td>
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center;">&nbsp;</td>
            <td style="padding: 5px 5px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center;">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <table class="food_detail" cellpadding="0" cellspacing="0" style="width: 100%;  border:1px solid #ccc; margin-bottom: 15px;border-collapse: collapse; line-height: 1.2em; border-radius: 15px 15px 0px 0px !important;
    overflow: hidden;">
    <thead>
    <tr>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a; border-radius: 15px 0px 0px 0px;">ID</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: left; border: 1px solid #11336a; width:15%">Name</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Srv. Size</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">MMA</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">WGR</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">FRU</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">MLK</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">VEG</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">DG</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">STAR</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">R/O</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">LEG</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">OTH</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Planned</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Prepared</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Added/Left Over</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Temp 1</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Temp 2</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Temp 3</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a;">Adult Meals</th>
      <th style="padding: 10px 5px 5px; font-weight: 700; color: #fff; font-size: 10px; background-color: #1e437f; text-align: center; border: 1px solid #11336a; border-radius: 0px 15px 0px 0px;">A La Carte</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menuCycleDay->menuCycleDayOptions as $menu)
      @foreach($menu->menuCycleDayOptionComponents->sortBy('recipe.category_sort') as $component)
        <?php
          $ingre_array_recipe = [
            "usda_componenent_meat"=>	0,
            "usda_componenent_grain"=>0,
            "usda_componenent_fruit"=>0,
            "usda_componenent_milk"=>0,
            "usda_componenent_veg"=>0,
            "usda_componenent_veggrn"=>0,
            "usda_componenent_vegred"=>0,
            "usda_componenent_vegleg"=>0,
            "usda_componenent_vegstar"=>0,
            "usda_componenent_vegothr"=>0,
            "usda_componenent_meat_override"=>0,
            "usda_componenent_grain_override"=>0,
            "usda_componenent_fruit_override"=>0,
            "usda_componenent_milk_override"=>0,
            "usda_componenent_veg_override"=>0,
            "usda_componenent_veggrn_override"=>0,
            "usda_componenent_vegred_override"=>0,
            "usda_componenent_vegleg_override"=>0,
            "usda_componenent_vegstar_override"=>0,
            "usda_componenent_vegothr_override"=>0,
            "cals"=>0,
            "sod"=>0,
            "fat"=>0,
            "prot"=>0,
            "carb"=>0
          ];
        ?>
         @if(!$menu->a_la_carte && $component->recipe->ingredients_total != '' && count($component->recipe->ingredients_total) > 0)
        
          @foreach($component->recipe->ingredients_total as $ingree)
            <?php
               
              $ingre_array_recipe['usda_componenent_meat'] += isset($ingree->usda_componenent_meat_override)?$ingree->usda_componenent_meat_override:$ingree->usda_componenent_meat;
              $ingre_array_recipe['usda_componenent_grain'] += isset($ingree->usda_componenent_grain_override)?$ingree->usda_componenent_grain_override:$ingree->usda_componenent_grain;
              $ingre_array_recipe['usda_componenent_fruit'] += isset($ingree->usda_componenent_fruit_override)?$ingree->usda_componenent_fruit_override:$ingree->usda_componenent_fruit;
              $ingre_array_recipe['usda_componenent_milk'] += isset($ingree->usda_componenent_milk_override)?$ingree->usda_componenent_milk_override:$ingree->usda_componenent_milk;
              $ingre_array_recipe['usda_componenent_veg'] += isset($ingree->usda_componenent_veg_override)?$ingree->usda_componenent_veg_override:$ingree->usda_componenent_veg;
              $ingre_array_recipe['usda_componenent_veggrn'] += isset($ingree->usda_componenent_veggrn_override)?$ingree->usda_componenent_veggrn_override:$ingree->usda_componenent_veggrn;
              $ingre_array_recipe['usda_componenent_vegred'] += isset($ingree->usda_componenent_vegred_override)?$ingree->usda_componenent_vegred_override:$ingree->usda_componenent_vegred;
              $ingre_array_recipe['usda_componenent_vegleg'] += isset($ingree->usda_componenent_vegleg_override)?$ingree->usda_componenent_vegleg_override:$ingree->usda_componenent_vegleg;
              $ingre_array_recipe['usda_componenent_vegstar'] += isset($ingree->usda_componenent_vegstar_override)?$ingree->usda_componenent_vegstar_override:$ingree->usda_componenent_vegstar;
              $ingre_array_recipe['usda_componenent_vegothr'] += isset($ingree->usda_componenent_vegothr_override)?$ingree->usda_componenent_vegothr_override:$ingree->usda_componenent_vegothr;
              $ingre_array_recipe['usda_componenent_meat_override'] += $ingree->usda_componenent_meat_override;
              $ingre_array_recipe['usda_componenent_grain_override'] += $ingree->usda_componenent_grain_override;
              $ingre_array_recipe['usda_componenent_fruit_override'] += $ingree->usda_componenent_fruit_override;
              $ingre_array_recipe['usda_componenent_milk_override'] += $ingree->usda_componenent_milk_override;
              $ingre_array_recipe['usda_componenent_veg_override'] += $ingree->usda_componenent_veg_override;
              $ingre_array_recipe['usda_componenent_veggrn_override'] += $ingree->usda_componenent_veggrn_override;
              $ingre_array_recipe['usda_componenent_vegred_override'] += $ingree->usda_componenent_vegred_override;
              $ingre_array_recipe['usda_componenent_vegleg_override'] += $ingree->usda_componenent_vegleg_override;
              $ingre_array_recipe['usda_componenent_vegstar_override'] += $ingree->usda_componenent_vegstar_override;
              $ingre_array_recipe['usda_componenent_vegothr_override'] += $ingree->usda_componenent_vegothr_override;
            ?>
          @endforeach
        @endif
        <tr>
         
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">          
          {{substr($component->recipe->id,-4)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: left; font-weight: 700;line-height: 1.1em;">{{$component->recipe->show_name}}</td>
          @if(!$menu->a_la_carte) 
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">
          {{ decToFraction($component->recipe->serving_size) }} {{ ($component->recipe->unitOfMesurment)?$component->recipe->unitOfMesurment->sort_name :'' }}
          </td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{ round($ingre_array_recipe['usda_componenent_meat'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_grain'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_fruit'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_milk'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_veg'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_veggrn'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_vegstar'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_vegred'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_vegleg'],2)}}</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">{{round($ingre_array_recipe['usda_componenent_vegothr'],2)}}</td>

          @else 

          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">
          -
          </td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">-</td>

          @endif
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
          <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; font-weight: 700;line-height: 1.1em;">&nbsp;</td>
        </tr>
        @if($component->recipe->ingredients_total != '' && count($component->recipe->ingredients_total) > 0)
          @foreach($component->recipe->ingredients_total as $ing=>$ingredient)
          <tr style="background-color: #f9f9f9; {{ ($loop->last)?'border-bottom: 4px solid #d7d7d7;':''}}">
          <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;line-height: 1.1em;">{{substr($component->recipe->ingredients[$ing]->id,-4)}}</td>
            <td style="padding: 10px 10px 10px 20px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: left;line-height: 1.1em;">{{$component->recipe->ingredients[$ing]->name}}<br/>{{ ($component->recipe->ingredients[$ing]->prefer_product)?$component->recipe->ingredients[$ing]->prefer_product->name:'' }} - {{substr(($component->recipe->ingredients[$ing]->prefer_product)?$component->recipe->ingredients[$ing]->prefer_product->id:'',-4)}}</td>
            @if(!$menu->a_la_carte)            
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">{{ decToFraction($component->recipe->serving_size) }} {{($component->recipe->unitOfMesurment)?$component->recipe->unitOfMesurment->sort_name : ''}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;line-height: 1.1em; ">{{isset($ingredient->usda_componenent_meat_override)?$ingredient->usda_componenent_meat_override:round($ingredient->usda_componenent_meat, 2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;">{{isset($ingredient->usda_componenent_grain_override)?$ingredient->usda_componenent_grain_override:round($ingredient->usda_componenent_grain,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">{{isset($ingredient->usda_componenent_fruit_override)?$ingredient->usda_componenent_fruit_override:round($ingredient->usda_componenent_fruit,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;line-height: 1.1em;">{{isset($ingredient->usda_componenent_milk_override)?$ingredient->usda_componenent_milk_override:round($ingredient->usda_componenent_milk,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">{{isset($ingredient->usda_componenent_veg_override)?$ingredient->usda_componenent_veg_override:round($ingredient->usda_componenent_veg,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">{{isset($ingredient->usda_componenent_veggrn_override)?$ingredient->usda_componenent_veggrn_override:round($ingredient->usda_componenent_veggrn,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">{{isset($ingredient->usda_componenent_vegstar_override)?$ingredient->usda_componenent_vegstar_override:round($ingredient->usda_componenent_vegstar,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">{{isset($ingredient->usda_componenent_vegred_override)?$ingredient->usda_componenent_vegred_override:round($ingredient->usda_componenent_vegred,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">{{isset($ingredient->usda_componenent_vegleg_override)?$ingredient->usda_componenent_vegleg_override:round($ingredient->usda_componenent_vegleg,2)}}</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;line-height: 1.1em; ">{{isset($ingredient->usda_componenent_vegothr_override)?$ingredient->usda_componenent_vegothr_override:round($ingredient->usda_componenent_vegothr,2)}}</td>
            
            @else
             
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;line-height: 1.1em; ">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">-</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center;line-height: 1.1em; ">-</td>
            @endif
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
            <td style="padding: 10px;font-size: 11px; text-align: center; border: 1px solid #ccc; text-align: center; line-height: 1.1em;">&nbsp;</td>
          </tr>
          @endforeach
          
        @endif
      @endforeach
      
    @endforeach
    <tr style="background-color: #919191; border-bottom: 4px solid #7a7a7a;">
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: right; color: #fff; font-weight: 700;" colspan="3">Daily Totals</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{ round($ingre_array['usda_componenent_meat'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_grain'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_fruit'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_milk'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_veg'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_veggrn'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_vegstar'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_vegred'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_vegleg'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;">{{round($ingre_array['usda_componenent_vegothr'], 2)}}</td>
        <td style="padding: 10px;font-size: 12px; text-align: center; border: 1px solid #ccc; text-align: center; color: #fff; font-weight: 700;" colspan="8">&nbsp;</td>
    </tr>
    </tbody>
  </table>

  <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; margin-bottom: 10px;">
    <tr valign="bottom">
      <td style="padding-right: 50px; width: 58%;">
        <table cellpadding="0" cellspacing="0" style="width: 100%; border:0; margin-bottom: 15px;">
          <tr valign="top">
            <td style="padding: 0; font-weight: 700; color: #1e437f; font-size: 14px; width: 12%;">SERVING&nbsp;NOTES:</td>
            <td style="width: 90%;">
              <p style="width: 90%; border-bottom: 1px solid #6e6e6e; margin:0px; padding:0px; line-height:normal;">&nbsp;</p>
              <p style="width: 90%; border-bottom: 1px solid #6e6e6e; margin:0px; padding:0px; line-height:normal;">&nbsp;</p>
            </td>
          </tr>
        </table>
      </td>
      <td style="width: 42%; text-align: right;">
        <img src="{{ global_asset('images/pdf-logo.png') }}" width="250" height="auto" alt="" style="image-rendering: -moz-crisp-edges; image-rendering: -o-crisp-edges; image-rendering: -webkit-optimize-contrast; image-rendering: optimizeQuality; -ms-interpolation-mode: bicubic;">
      </td>
    </tr>
  </table>

</div>
 <script type="text/php">
    if ( isset($pdf) ) {
        $y = $pdf->get_height() - 24;
        $x = $pdf->get_width() - 100;
        $pdf->page_text($x, $y, "Page: {PAGE_NUM} of {PAGE_COUNT}", '', 12, array(0,0,0));
    }
</script> 
</body>
</html>