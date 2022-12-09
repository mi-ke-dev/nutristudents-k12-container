<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use App\Http\Controllers\Controller;
use Bytelaunch\Nutristudents\Models\SiteSetting;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Bytelaunch\Nutristudents\Enum\ExcelTypeEnum;

class ProductImportController extends Controller
{
    public function worldSyncProduct1(Request $request)
    {
        return Jetstream::inertia()->render($request, 'ProductImportExcel/worldSyncProductImportExcel');
    }

    public function importSyncProductUploadStore(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required',
        ],
        
        ['file.required' => '1World Sync excel is required.']
    ); 
        $label = ExcelTypeEnum::WORLDSYNCEXCEL1;
        $img_upload_url = Storage::copy(
            $request->file['key'],
            str_replace('tmp/', 'ProductExcelFileImported/excelFile/', $request->file['key'])
        );
        $img_upload_url_final = str_replace('tmp/', 'ProductExcelFileImported/excelFile/', $request->file['key']);

        $excelimport = SiteSetting::updateOrCreate(
            ['label' => $label],
            ['label' => $label, 'value' => $img_upload_url_final]

        );
        return redirect()->route('product-world-Sync-excel-import');
    }

    public function cnProductImportExcel(Request $request)
    {
        return Jetstream::inertia()->render($request, 'ProductImportExcel/cnProductExcelImport');
    }

    public function importCnProductUploadStore(Request $request)
    {
        $validated = $request->validate([
            'cnfile' => 'required',
        ],
        ['cnfile.required' => 'CN24 excel is required.']
    );
        $label = ExcelTypeEnum::CN24;
        $img_upload_url = Storage::copy(
            $request->cnfile['key'],
            str_replace('tmp/', 'ProductExcelFileImported/excelCn24File/', $request->cnfile['key'])
        );
        $img_upload_url_final = str_replace('tmp/', 'ProductExcelFileImported/excelFile/', $request->cnfile['key']);

        $excelimport = SiteSetting::updateOrCreate(
            ['label' => $label],
            ['label' => $label, 'value' => $img_upload_url_final]

        );
        return redirect()->route('product-cn-excel-import');
    }
}
