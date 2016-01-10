#!/bin/bash

filename=$1
if [[ -z "$filename" ]]
then
	echo "ERROR: specify the file to process"
	exit 1
fi

echo "Processing sniffs with auto-fixable errors for file '$filename'"
echo

# Parse phpcs output, retrieve unique list of sniffs from 2nd line
# for auto-fixable errors
snifflist=$(
	phpcs $filename --report-width=250 -s |
		sed -rn -e '/\[x\]/{n;s/^.*\((.*+)\.\w+\).*$/\1/p}' |
		sort -u
	)

#logfile=$(mktemp)
logfile=/tmp/psr.log

for sniff in $snifflist
do
	echo "##### $sniff"

	phpcbf --no-colors --sniffs=$sniff $filename --report-width=auto >$logfile

	grep '\[ \]' $logfile >/dev/null && {
		echo; cat $logfile
	}
#	cat $logfile # |sed -r '/^\s+=>/s/^.* ([0-9]+)\/([0-9]+).*$/\1 \2/'

done
#rm $logfile
