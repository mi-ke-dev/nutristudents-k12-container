<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
		.editor_box p {
			margin: 0px;
		}
	</style>
</head>

<body>
	<div style="padding:20px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 22px;">
		<table cellpadding="0" cellspacing="0" style="width: 100%; border:0; margin-bottom: 30px; page-break-inside: auto;">
			<tr>
				<td style="padding:15px;">
					<img src="{{ global_asset('images/pdf-logo.png') }}" width="270" height="auto" alt="" style="image-rendering: -moz-crisp-edges; image-rendering: -o-crisp-edges; image-rendering: -webkit-optimize-contrast; image-rendering: optimizeQuality; -ms-interpolation-mode: bicubic; max-width: 100%;">
				</td>
				<td style="padding:15px; text-align: right; font-weight: bold; font-size: 22px;">Group Meal Preparation Report</td>
			</tr>
			<tr>
				<td colspan="2">
					
				</td>
			</tr>	
		</table>
		<table cellpadding="0" cellspacing="0" style="width: 100%; border:0; margin-bottom: 30px; page-break-inside: auto; border-collapse: collapse;">
						<tr style="background-color: #808080;">
							<th style="padding: 5px 10px; color:#fff; text-align: left; width:80%; border:1px solid #808080;">Recipe</th>
							<th style="padding: 5px 10px; color:#fff; text-align: right; width:20%; border:1px solid #808080;">Headcount</th>
						</tr>

						@foreach($preps as $prep)
						<tr>
							@if($prep['type'] == 'recipe')
							@if($loop->index > 0)
							<td style="padding: 5px 10px; border:1px solid #c2c2c2;">&nbsp;</td>
							<td style="padding: 5px 10px; border:1px solid #c2c2c2;">&nbsp;</td>
						</tr>
						<tr>
							@endif
							<td style="padding: 5px 10px; border:1px solid #c2c2c2;"><b>{{ $prep['name'] }}</b></td>
							<td style="padding: 5px 10px; border:1px solid #c2c2c2; text-align: right;">
								<b>
									@if($prep['override_count'] > 0)
									{{ $prep['override_count'] }}
									@else
									{{ $prep['student_count'] }}
									@endif
								</b>
							</td>
							@else
							<td style="padding: 5px 10px; border:1px solid #c2c2c2;">{{ $prep['name'] }}</td>
							<td style="padding: 5px 10px; border:1px solid #c2c2c2; text-align: right;">
								@if($prep['override_count'] > 0)
								{{ $prep['override_count'] }}
								@else
								{{ $prep['student_count'] }}
								@endif
							</td>
							@endif
						</tr>
						@endforeach
					</table>
	</div>
</body>

</html>