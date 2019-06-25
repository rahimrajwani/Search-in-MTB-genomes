<?php 
list($Position, $Varnucl)  = explode('#', htmlspecialchars($_POST['Variation']));
header("Location: Reterive_seq_from_reference.php?refeseq_position=$Position&variant_nucleotide=$Varnucl");
?>