<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.2;">
    <table cellpadding="0" cellspacing="0" style="width: 100%; border:0;">
        <tr>
            <td style="padding-right: 50px; width: 50%;">
                <table cellpadding="0" cellspacing="0" style="border:0;">
                    <tr>
                        <td style="border-right:1px solid #ccc; padding: 0 30px 0 0;">
                            <p style="margin: 0 0 5px; padding: 0; font-weight: 700; color: #132d56; font-size: 18px; line-height: 1.2;">{{ $menuCycleDayOption->name }}</p>
                        </td>
                        <td style="padding: 0 30px 0;text-align: center;">
                            <p style="margin: 0 0 5px; padding: 0; font-weight: 700; color: #39b54a; font-size: 12px; line-height: 1.2;">SERVING SIZE</p>
                            <p style="margin: 0 0 0; padding: 0; font-weight: 700; color: #132d56; font-size: 15px; line-height: 1.2;">{{ $menuCycleDayOption->assembly_serving_free_text }} </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%; text-align: right;">
                <img src="{{ global_asset('images/pdf-logo.png') }}" width="270" height="auto" alt="" style="image-rendering: -moz-crisp-edges; image-rendering: -o-crisp-edges; image-rendering: -webkit-optimize-contrast; image-rendering: optimizeQuality; -ms-interpolation-mode: bicubic;">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table cellpadding="0" cellspacing="0" style="width: 100%; border:none;border-collapse: collapse; margin-top: 30px;">
                    <tr valign="top">
                        <td style="width: 35%;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <th style="padding: 10px 15px; font-weight: 700; color: #fff; font-size: 12px; background-color: #1e437f; text-align: left;border-radius: 10px 0 0 0;">No.</th>
                                    <th style="padding: 10px 15px; font-weight: 700; color: #fff; font-size: 12px; background-color: #1e437f; text-align: left;">Recipe Name</th>
                                </tr>
                                <tbody style="border: 1px solid #ccc; border-top:none">
                                    @foreach($menuCycleDayOption->menuCycleDayOptionComponents as $menuCycleDayOptionComponent)
                                        <tr>
                                            <td style="padding: 10px 15px;font-size: 12px; text-align: left;color: #6e6e6e;">{{ $menuCycleDayOptionComponent->recipe->custom_id }}</td>
                                            <td style="padding: 10px 15px;font-size: 12px; text-align: left;color: #6e6e6e;">{{ $menuCycleDayOptionComponent->recipe->name }}</td>
                                        </tr>                                        
                                    @endforeach   
                                </tbody>
                                
                            </table>
                        </td>
                        <td style="width: 65%;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; border:none;border-collapse: collapse;">
                                <tr>
                                    <th style="padding: 10px 20px; font-weight: 700; color: #fff; font-size: 12px; background-color: #1e437f; text-align: left;border-radius: 0 10px 0 0;">Assembly Instructions</th>
                                </tr>                    
                                <tr>
                                    <td style="padding:20px 20px;font-size: 12px; text-align: left; border: 1px solid #ccc; border-top:0">
                                        {!! $menuCycleDayOption->assembly_instructions !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table> 
            </td>
        </tr>
    </table>   
</div>
