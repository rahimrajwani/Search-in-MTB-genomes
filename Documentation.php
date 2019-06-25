<?php 
echo file_get_contents("header.html");
?>
<p class="question">What was the motivation for Search-in-MTB-genomes?</p>
<p>The number of public genomes for <i>M. tuberculosis</i> (MTB) is rapidly increasing and there is no other tool to do quick searches for SNPs among them. A few that were developed are not frequently updated. Therefore, Search-in-MTB-genomes was developed to provide a continually updated resource for searching SNPs in all public MTB genomes.
<p class="question">How can Search-in-MTB-genomes help my research?</p>
<p>Search-in-MTB-genomes provides a list of public genomes that contains the queried SNP/sequence. 
   <ul style="list-style-type:circle">
   <li>This SNP may be the one present in the locally isolated strain being studied by you and it may be of interest to see which previously genome-sequenced strains also harbor the same SNP. Where were these strains isolated? Which study reports them? These questions can be explored very quickly using Search-in-MTB-genomes.</li> 
   <li>This SNP could be a phylogenetic marker and you might wish to download these genomes for subsequent analysis.</li> 
   <li>This SNP could be a drug-resistance mutation and you might wish to study them further.</li> 
 </ul></p>
<p class="question">How frequently is Search-in-MTB-genomes updated?</p>
<p>Every 24 hours.</p>
<p class="question">How does Search-in-MTB-genomes detect SNP?</p>
<p>Search-in-MTB-genomes extracts a short sequence surrounding the SNP position and searches for this sequence in all genomes.</p>
<p class="question">How can I trust the result from Search-in-MTB-genomes?</p>
<p>We validated the Search-in-MTB-genomes approach against alignment-based SNP calling approach and found no significant difference. The detailed analysis is yet to be published.</p>
<p class="question">How can I cite Search-in-MTB-genomes?</p>
<p>A publication describing this tool is yet to be published. Please stay tuned. We will provide the reference here.</p>
<?php echo file_get_contents("footer.html"); ?>