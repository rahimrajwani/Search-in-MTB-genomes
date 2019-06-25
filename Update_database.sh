#!/bin/bash
## Download the summary table
Path_to_database=public_html/Database
mv $Path_to_database/assembly_summary.txt.1 $Path_to_database/assembly_summary.txt
wget -P $Path_to_database ftp://ftp.ncbi.nlm.nih.gov/genomes/genbank/bacteria/Mycobacterium_tuberculosis/assembly_summary.txt
## Compare the new file with the old one
comm -13 $Path_to_database/assembly_summary.txt $Path_to_database/assembly_summary.txt.1 > $Path_to_database/new_genomes_metadata.txt
## Check if new genomes are available:
if [ -s "public_html/Database/new_genomes_metadata.txt" ]
then
	## Download the genomes
	grep -v '^#' $Path_to_database/new_genomes_metadata.txt | cut -f20 | sed 's/$/\/*[0-9]_genomic.fna.gz/g' > $Path_to_database/URLs.txt
	wget -P $Path_to_database -i $Path_to_database/URLs.txt
	## Unzip 
	gunzip $Path_to_database/*.gz
	## Delete newline characters
	sed -i ':a;N;$!ba;s/\n//g' $Path_to_database/*.fna
	echo -e "$(date) :" "$(wc -l $Path_to_database/new_genomes_metadata.txt|cut -f1) new genomes were available.\n" >> $Path_to_database/Update.log
else
	echo -e "$(date) :" "No new genomes were available.\n" >> $Path_to_database/Update.log
fi
## Move all new genomes to the directory
mv $Path_to_database/*.fna -t $Path_to_database/dir