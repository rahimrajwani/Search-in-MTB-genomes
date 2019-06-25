<?php 
clearstatcache();
session_unset();
session_destroy();
session_write_close();
echo file_get_contents("header.html");
?>
<body>


<div id='Mainpage_paragraph'>
<legend align="center">Introduction</legend>
<p align="justify">
Search-in-MTB-genomes is an online tool that allow users to search for any mutation (e.g. those associated with <i>M. tuberculosis</i> lineage or drug resistance) within all available <i>M. tuberculosis</i> genomes. The program outputs a list of all currently sequenced genomes that harbors the queried mutation.<br/>
</p> 
<?php 
$Current_number_of_genomes=shell_exec("grep -c -P -v '^#' Database/assembly_summary.txt");
$date = date('Y-m-d');
echo "<p><b>Last updated on : $date <br/> Number of genomes available: $Current_number_of_genomes</b></p>";
?>
</div>

<div id='Seqsearch_form'>
<form action="Search.php" method="post">
<legend align="center">Search for a query sequence</legend>
 <p><label for="inputsequence">Search sequence:<label/><br/><br/>
 <input type="text" name="inputsequence" pattern="[ATGCatgc]+" title="Valid nucleotide characters (A,T,G or C) only" required /></p>
 <p><input type="submit" value="Search >>"/></p>
</form>
</div>

<div id='SNPsearch_form'>
<form action="Reterive_seq_from_reference.php" method="get">
 <legend align="center">Search for a SNP</legend>
 <p><label for="refeseq_position">Position on NC_000962.3:</b><label/><br/><br/>
   <input type="number" name="refeseq_position" min="1" max="4411532" required>
 <p><label for="variant_nucleotide">Alternative nucleotide:<label/><br/><br/>
  <select name="variant_nucleotide">
  <option value="A">A</option>
  <option value="T">T</option>
  <option value="G">G</option>
  <option value="C">C</option>
</select>
<p><input type="submit"  value="Search >>"/></p>
</form>
</div>


</body>
<?php echo file_get_contents("footer.html"); ?>