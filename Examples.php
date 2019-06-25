<?php 
clearstatcache();
session_unset();
session_destroy();
session_write_close();
echo file_get_contents("header.html");
?>
<p align="justify">
The Search-in-MTB-genomes could be used to search for lineage or drug-resistance associated mutations. Below are are some examples:<br/>
</p> 

<form action="Examples_process.php" method="post">
 
<legend align="center"> Example 1: SNPs associated with MTBC lineage<br/></legend>
  
 <p><label for="Variation">Select the lineage associated SNP to search for<label/><br/><br/>
  <select name="Variation">
<option value="615938#A">lineage1 615938-->A</option>
<option value="4404247#A">lineage1.1 4404247-->A</option>
<option value="3021283#A">lineage1.1.1 3021283-->A</option>
<option value="3216553#A">lineage1.1.1.1 3216553-->A</option>
<option value="2622402#A">lineage1.1.2 2622402-->A</option>
<option value="1491275#A">lineage1.1.3 1491275-->A</option>
<option value="3479545#A">lineage1.2.1 3479545-->A</option>
<option value="3470377#T">lineage1.2.2 3470377-->T</option>
<option value="497491#A">lineage2 497491-->A</option>
<option value="1881090#T">lineage2.1 1881090-->T</option>
<option value="2505085#A">lineage2.2 2505085-->A</option>
<option value="797736#T">lineage2.2.1 797736-->T</option>
<option value="4248115#T">lineage2.2.1.1 4248115-->T</option>
<option value="3836274#A">lineage2.2.1.2 3836274-->A</option>
<option value="346693#T">lineage2.2.2 346693-->T</option>
<option value="3273107#A">lineage3 3273107-->A</option>
<option value="1084911#A">lineage3.1.1 1084911-->A</option>
<option value="3722702#C">lineage3.1.2 3722702-->C</option>
<option value="1237818#G">lineage3.1.2.1 1237818-->G</option>
<option value="2874344#A">lineage3.1.2.2 2874344-->A</option>
<option value="931123#T">lineage4 931123-->T</option>
<option value="62657#A">lineage4.1 62657-->A</option>
<option value="514245#T">lineage4.1.1 514245-->T</option>
<option value="1850119#T">lineage4.1.1.1 1850119-->T</option>
<option value="541048#G">lineage4.1.1.2 541048-->G</option>
<option value="4229087#T">lineage4.1.1.3 4229087-->T</option>
<option value="891756#G">lineage4.1.2 891756-->G</option>
<option value="107794#T">lineage4.1.2.1 107794-->T</option>
<option value="2411730#C">lineage4.2 2411730-->C</option>
<option value="783601#C">lineage4.2.1 783601-->C</option>
<option value="1487796#A">lineage4.2.2 1487796-->A</option>
<option value="1455780#C">lineage4.2.2.1 1455780-->C</option>
<option value="764995#G">lineage4.3 764995-->G</option>
<option value="615614#A">lineage4.3.1 615614-->A</option>
<option value="4316114#A">lineage4.3.2 4316114-->A</option>
<option value="3388166#G">lineage4.3.2.1 3388166-->G</option>
<option value="403364#A">lineage4.3.3 403364-->A</option>
<option value="3977226#A">lineage4.3.4 3977226-->A</option>
<option value="4398141#A">lineage4.3.4.1 4398141-->A</option>
<option value="1132368#T">lineage4.3.4.2 1132368-->T</option>
<option value="1502120#A">lineage4.3.4.2.1 1502120-->A</option>
<option value="4307886#A">lineage4.4 4307886-->A</option>
<option value="4151558#A">lineage4.4.1 4151558-->A</option>
<option value="355181#A">lineage4.4.1.1 355181-->A</option>
<option value="2694560#C">lineage4.4.1.2 2694560-->C</option>
<option value="4246508#A">lineage4.4.2 4246508-->A</option>
<option value="1719757#T">lineage4.5 1719757-->T</option>
<option value="3466426#A">lineage4.6 3466426-->A</option>
<option value="4260268#C">lineage4.6.1 4260268-->C</option>
<option value="874787#A">lineage4.6.1.1 874787-->A</option>
<option value="1501468#C">lineage4.6.1.2 1501468-->C</option>
<option value="4125058#C">lineage4.6.2 4125058-->C</option>
<option value="3570528#G">lineage4.6.2.1 3570528-->G</option>
<option value="2875883#T">lineage4.6.2.2 2875883-->T</option>
<option value="4249732#G">lineage4.7 4249732-->G</option>
<option value="3836739#A">lineage4.8 3836739-->A</option>
<option value="1759252#G">lineage4.9 1759252-->G</option>
<option value="1799921#A">lineage5 1799921-->A</option>
<option value="1816587#G">lineage6 1816587-->G</option>
<option value="1137518#A">lineage7 1137518-->A</option>
<option value="2831482#G">lineageBOV 2831482-->G</option>
<option value="1882180#T">lineageBOV_AFRI 1882180-->T</option>
</select>


<p><input type="submit"  value="Search >>"/></p>
</form>


<form action="Examples_process.php" method="post">
 
<legend align="center"> Example 2: SNPs associated with resistance to anti-tubercular drugs<br/></legend>
  
 <p><label for="Variation">Select the drug-resistance associated SNP to search for<label/><br/><br/>
  <select name="Variation">
<option value="2155168#G">ISONIAZID katG Ser315Thr(2155168 -> G)</option>
<option value="4247429#G">ETHAMBUTOL embB Met306Val(4247429 -> G)</option>
<option value="761155#T">RIFAMPICIN rpoB Ser450Leu(761155 -> T)</option>
</select>


<p><input type="submit"  value="Search >>"/></p>
</form>
<?php echo file_get_contents("footer.html"); ?>