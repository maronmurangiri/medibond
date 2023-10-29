 <?php
 // get the name of the input PDF

  $inputFile = "C:\wamp64\www\medibond\\receipt.php";

  // get the name of the output MS-WORD file
  $outputFile = "C:\wamp64\www\medibond\\receipt.pdf";
  
  try

    {

   $oLoader = new COM("easyPDF.Loader.8");

      $oPrinter = $oLoader->LoadObject("easyPDF.Printer.8");

      $oPrintJob = $oPrinter->PrintJob;

      $oPrintJob->PrintOut ($inputFile, $outputFile);

      print "Success";

    }

  

  catch(com_exception $e)

    {

      Print "error code".$e->getcode(). "\n";

      print $e->getMessage();

    }

