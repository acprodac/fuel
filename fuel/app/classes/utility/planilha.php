<?php
class Utility_Planilha
{
	public static function get_tab($plan)
	{
        try {
    		Package::load('excel');

    		$inputFileType = PHPExcel_IOFactory::identify($plan);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            //$objReader->setReadDataOnly(true);

            $objReader->setLoadAllSheets();
            $objExcel = $objReader->load($plan);

            $rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
            $rendererLibrary = 'mpdf.php';
            $rendererLibraryPath = DOCROOT . 'fuel' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . 'mpdf';

            /*$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
            $rendererLibrary = 'dompdf.php';
            $rendererLibraryPath = DOCROOT . 'fuel' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . 'dompdf';*/

            /*$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibrary = 'tcpdf.php';
            $rendererLibraryPath = DOCROOT . 'fuel' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . 'tcpdf';*/

    		PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath);

    		$tabs = array();
            $keyPrint = 0;

            $indexSheet = array();

            /*foreach($objExcel->getWorksheetIterator() as $k=>$worksheet){
                $indexSheet[$k] = (integer) $objExcel->getIndex($worksheet);
            }*/

            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );

    		foreach($objExcel->getWorksheetIterator() as $k=>$worksheet){
            	$name = strtolower($worksheet->getTitle());
            	$index = (integer) $objExcel->getIndex($worksheet);

                $indexSheet[$k] = (integer) $objExcel->getIndex($worksheet);

            	if(strpos($name, 'plmo') !== false){
                    unset($indexSheet[$k]);

                    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
                    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);


                    //percorre todas as células

                    echo $highestRow . '<br>';
                    echo $highestColumn . '<br>';
                    echo $highestColumnIndex . '<br><br><br>';

                    for($line = 1; $line <= $highestRow; $line++){
                        for($letter = 'A'; $letter <= $highestColumn; $letter++){

                            $cell = $worksheet->getCell($letter . $line);
                            $val = $cell->getFormattedValue();

                            //echo $letter . ':' . $line . ' - ' . $cell->getFormattedValue() . '<br><br>';

                            //$cell->setValue($val);
                        }
                    }

                    $objExcel->getActiveSheet()->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray($styleArray);

                    //$tabs[] = clone $worksheet;

                    //$tabs[] = clone $worksheet;
                    //$keyPrint = $index;
      				//$objExcel->removeSheetByIndex($index);
      			} else {
                    //$worksheet->setSheetState(PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN);
                }
      		}

            $indexSheet = array_reverse($indexSheet);

            foreach($indexSheet as $indexR){
                $objExcel->removeSheetByIndex($indexR);
            }

            /*for($i = ; $i >= 0; $i--){
                $objExcel->removeSheetByIndex($index);
            }*/



            print_r($indexSheet);

            //unset($objExcel);

            /*$ObjNew = new PHPExcel();

            echo count($tabs);

            foreach($tabs as $key=>$tab){
                $tab->setTitle('Teste');
                $ObjNew->addSheet($tab, $key);
                $ObjNew->setActiveSheetIndex($ObjNew->getIndex($tab));
            }*/


            /*foreach($tabs as $key=>$tab){
                $tab->setTitle('Teste');
                $objExcel->addSheet($tab, $key);
                $objExcel->setActiveSheetIndex($objExcel->getIndex($tab));
            }*/

            //$objWriter = PHPExcel_IOFactory::createWriter($objExcel, $inputFileType);
            //$objWriter->save(DOCROOT . '_teste' . DIRECTORY_SEPARATOR . date('Ymd-Hms') . '_teste.xls');

            $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'PDF');
            $objWriter->writeAllSheets();
            $objWriter->setPreCalculateFormulas(true);
            $objWriter->save(DOCROOT . '_teste' . DIRECTORY_SEPARATOR . date('Ymd-Hms') . '_teste.pdf');

            exit;

            /*
                $teste = new PHPExcel();

                foreach($tabs as $key=>$tab){
                    $tab->setTitle('Teste');
                    $teste->addSheet($tab, $key);
                    $teste->setActiveSheetIndex($teste->getIndex($tab));
                }

                $objWriter = PHPExcel_IOFactory::createWriter($teste, $inputFileType);
                $objWriter->save(DOCROOT . '_teste' . DIRECTORY_SEPARATOR . date('Ymd-Hms') . '_teste.xls');

                echo count($tabs);

            } catch(Exception $e){
                echo $e->getMessage() . '<br><br>';
                echo $e->getCode() . '<br><br>';
                echo $e->getFile() . '<br><br>';
                echo $e->getLine() . '<br><br>';
                echo $e->getTraceAsString() . '<br><br>';
            }

            exit;*/



            //$objExcel->setActiveSheetIndex($keyPrint);

    		/*$count = $objExcel->getSheetCount();

    		for($i = 0; $i < $count; $i++){
    			$sheet = $objExcel->getSheetByIndex($i);

    			if(empty($sheet)){
    				echo 'NOT';
    				continue;
    			}

    			$objExcel->removeSheetByIndex($i);
    		}*/

            /*foreach($relat->getWorksheetIterator() as $k=>$worksheet){
            	$name = strtolower($worksheet->getTitle());

            	$test = strpos($name, 'plmo');

            	echo $name;
            	
            	echo '<br/>';

            	if(strpos($name, 'plmo') !== false){
            		/*$index = $relat->getIndex($worksheet);
            		echo 'Excluir ' . $k . ' - ' . $index . '<br/>' . '<br/>';
            		
    				$relat->removeSheetByIndex($index);*/
    				//echo 'Manter ' . '<br><br><br><br>';

    				//$tabs[] = clone $worksheet;
            	//}

            		//echo $k . ' - [OK] - ' . $name . '<br/>';
            		//$relat->setActiveSheetIndex($k);


            		/* Configuração mPDF */
            		

    				
    				/*PHPExcel_Settings::setpdfrendererpath(DOCROOT . 'fuel' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . 'mpdf');

    				PHPExcel_Settings::setpdfrenderername($rendererLibrary);*/

    				//  Here's the magic: you __tell__ PHPExcel what rendering engine to use
    				//     and where the library is located in your filesystem

    				/* Configuração mPDF */

            		/*$bla = PHPExcel_Settings::getPdfRendererPath();
            		print_r($bla);

            		echo 'OK';

            		exit;*/
            	//}

                /*$worksheetTitle     = $worksheet->getTitle();
                $highestRow         = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $dataCalls = $worksheet->getCellByColumnAndRow(2, 2)->getValue();
                $dataSubstr = substr($dataCalls, 53);*/
            //}

            /*echo '<br/><br/><br/><br/><br/><br/>';

            $phpExcel = new PHPExcel();
    		
    		foreach($tabs as $key=>$worksheet){
    			/*$phpExcel->getActiveSheet();
    			$phpExcel->setActiveSheetIndex($key);
    			$phpExcel->addSheet($worksheet);
           	}*/

            
            //$objExcel->setActiveSheetIndex(8);
            //$objWriter = PHPExcel_IOFactory::createWriter($objClone, 'PDF');
    		//$objWriter->writeAllSheets();
    		//$objWriter->setPreCalculateFormulas(true);
    		//$objWriter->save(DOCROOT . '_teste' . DIRECTORY_SEPARATOR . date('smH-Ymd') . '_teste.pdf');

            $objExcel->setActiveSheetIndex(8);
            $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'PDF');
            $objWriter->setPreCalculateFormulas(true);
            $objWriter->save(DOCROOT . '_teste' . DIRECTORY_SEPARATOR . date('Ymd-Hms') . '_teste.pdf');

        } catch(Exception $e){
            echo $e->getMessage() . '<br><br>';
            echo $e->getCode() . '<br><br>';
            echo $e->getFile() . '<br><br>';
            echo $e->getLine() . '<br><br>';
            echo $e->getTraceAsString() . '<br><br>';
        }
	}

    public static function get_word($file)
    {
        $mpdf = DOCROOT . 'fuel' . DIRECTORY_SEPARATOR . 'packages' . DIRECTORY_SEPARATOR . 'mpdf' . DIRECTORY_SEPARATOR . 'mpdf.php';

        require_once $mpdf;
    }
}