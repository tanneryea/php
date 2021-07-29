<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="Hit Counter" content="width=device-width, initial-scale=1" />

    <title>Hit Counter</title>
  </head>

  <body>

    <?php
    $CounterFile = "hitcount.txt";

    if (file_exists($CounterFile)){
        $Hits = file_get_contents($CounterFile);
        ++$Hits;
    } else {
        $Hits = 1;
    }

    echo "<h1>There have been $Hits hits to this page</h1>\n";

    if (file_put_contents($CounterFile, $Hits)){
        echo "<p>The counter file has been update.</p>\n";
    }

    ?>


  </body>
</html>