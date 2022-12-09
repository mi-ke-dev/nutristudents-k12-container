<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<div style="padding:20px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px;">
		<table cellpadding="0" cellspacing="0" style="width: 100%; border:0; margin-bottom: 30px; page-break-inside: auto;">
			<tr>
				<td style="padding-right: 50px; width: 50%;">
					<table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
						<tr>
							<td style="border-right:2px solid #ccc; padding: 0 10px 0 0;">
								<p style="margin: 0 0 2px; padding: 0; font-weight: 700; color: #132d56; font-size: 18px; line-height:normal;">{{$recipe->name}}</p>
								<p style="margin: 0 0 0; padding: 0; font-weight: 700; color: #919191; font-size: 15px; line-height:normal;">RECIPE # {{substr($recipe->id, -4)}}</p>
							</td>
							<td style="border-right:2px solid #ccc; padding: 0 10px 0;text-align: center;">
								<p style="margin: 0 0 2px; padding: 0; font-weight: 700; color: #39b54a; font-size: 12px; line-height:normal;">SERVING SIZE</p>
								<p style="margin: 0 0 0; padding: 0; font-weight: 700; color: #132d56; font-size: 15px; line-height:normal;">{{$recipe->serving_size}} {{ ($recipe->unitOfMesurment)?$recipe->unitOfMesurment->name : ''}}
							</p>
							</td>
							<td style="padding: 0 10px 0;text-align: center;">
								<p style="margin: 0 0 2px; padding: 0; font-weight: 700; color: #39b54a; font-size: 12px; line-height:normal;">STUDENT COUNT</p>
								<p style="margin: 0 0 0; padding: 0; font-weight: 700; color: #132d56; font-size: 15px; line-height:normal;">{{$studentCount}}</p>
							</td>
						</tr>
					</table>
				</td>
				<td style="width: 50%; text-align: right;">
					<img src="{{ asset('images/pdf-logo.png') }}" width="270" height="auto" alt="" style="image-rendering: -moz-crisp-edges; image-rendering: -o-crisp-edges; image-rendering: -webkit-optimize-contrast; image-rendering: optimizeQuality; -ms-interpolation-mode: bicubic;" >
				</td>
			</tr>
		</table>

		<table cellpadding="0" cellspacing="0" style="width: 100%; border:none;border-collapse: collapse; page-break-inside: auto; border-radius:20px 20px 0px 0px; overflow:hidden;">
			<tr valign="top">
				<td style="width: 65%;">
					<table cellpadding="0" cellspacing="0" style="width: 100%; border:none; margin-bottom: 15px;border-collapse: collapse;">
						<tr>
							<th style="padding: 10px; font-weight: 700; color: #fff; font-size: 14px; background-color: #1e437f; text-align: left; border: 1px solid rgba(204, 204, 204, 0.233);">No.</th>
							<th style="padding: 10px; font-weight: 700; color: #fff; font-size: 14px; background-color: #1e437f; text-align: left; border: 1px solid rgba(204, 204, 204, 0.233);">Ingredient Name</th>
							<th style="padding: 10px; font-weight: 700; color: #fff; font-size: 14px; background-color: #1e437f; text-align: left; border-left: 1px solid rgb(90 90 90); border-right: 1px solid rgb(90 90 90);">Qty & Measurement</th>
						</tr>
						@foreach($recipe->ingredients as $ing=>$ingrediant)
						<tr style="background: {{ $ing%2==1?'#f9f9f9':'#fff'}};">
							<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc;">{{substr($ingrediant->id, -4)}}</td>
							<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc;">{{$ingrediant->name}}</td>
							<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc;">
								{{ recipeConvertAccordingStudentCount($studentCount,  $recipe->portion, $recipe->ingredients_total[$ing], $recipe) }}
							</td>
						</tr>
						@endforeach
						
						<tr>
							<td colspan="3" style="border: 1px solid #ccc;">
								<table cellpadding="0" cellspacing="0" style="width: 100%; border:none;border-collapse: collapse; margin-top: 38px;">
									<tr>
										<th style="padding: 10px; font-weight: 700; color: #fff; font-size: 14px; background-color: #1e437f; text-align: left; width: 50%; border: 1px solid rgba(204, 204, 204, 0.233);">Nutrients Based on 1 Serving Size</th>
										<th style="padding: 10px; font-weight: 700; color: #fff; font-size: 14px; background-color: #1e437f; text-align: left; width: 50%; border: 1px solid rgba(204, 204, 204, 0.233);">Components</th>
									</tr>
									<tr>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc;">
											<strong style="display: inline-block; width: 150px;">Calories</strong> {{ round($ingre_array['cals'] ,2 ) }} cals
										</td>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc;">
											<strong style="display: inline-block; width: 150px;">Meat/Alt.</strong> {{round($ingre_array['usda_componenent_meat'],2)}}
										</td>
									</tr>
									<tr style="background:#f9f9f9;">
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
										<strong style="display: inline-block; width: 150px;">Sodium</strong> {{round($ingre_array['sod'],2)}} mg
										</td>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
											<strong style="display: inline-block; width: 150px;">Grains</strong> {{round($ingre_array['usda_componenent_grain'],2)}}
										</td>
									</tr>
									<tr>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
										<strong style="display: inline-block; width: 150px;">Fat</strong> {{round($ingre_array['fat'],2)}} g
										</td>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
											<strong style="display: inline-block; width: 150px;">Vegetable</strong>  {{round($ingre_array['usda_componenent_veg'],2)}}
										</td>
									</tr>
									<tr style="background:#f9f9f9;">
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
										<strong style="display: inline-block; width: 150px;">Prot</strong> {{round($ingre_array['prot'],2)}} g
										</td>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
											<strong style="display: inline-block; width: 150px;">Fruit</strong> {{round($ingre_array['usda_componenent_fruit'],2)}}
										</td>
									</tr>
									<tr>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
											<strong style="display: inline-block; width: 150px;">Carb</strong> {{round($ingre_array['carb'],2)}} g
										</td>
										<td style="padding: 5px 10px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-bottom: 0;">
											<strong style="display: inline-block; width: 150px;">Milk</strong> {{round($ingre_array['usda_componenent_milk'],2)}}
										</td>
									</tr>									
								</table>
							</td>
						</tr>
					</table>
				</td>
				<td style="width: 30%;">
					<table cellpadding="0" cellspacing="0" style="width: 100%; border:none;border-collapse: collapse; margin-top: 1px;">
						<tr>
							<th style="padding: 10px; font-weight: 700; color: #fff; font-size: 14px; background-color: #1e437f; text-align: left; border:none;">Cooking Instructions</th>
						</tr>
						<tr>
							<td style="padding:20px 15px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-top: 1px solid #1e437f;">
								<div style="font-size:12px; line-height:normal;">{!!$recipe->cooking_instructions!!}</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>

</html>