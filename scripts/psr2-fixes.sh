#!/bin/bash

if [[ -z "$*" ]]
then
	echo "ERROR: specify the file(s) to process"
	exit 1
fi

# Set function's 1st char to lowercase unless it contains a '_'
sed -ri 's/(function )(_?[A-Z])([^_]+\(+)/\1\L\2\E\3/' $*

# Protected methods start with '_'
sed -ri 's/^(\s*)(function _)/\1protected \2/' $*

# Other methods are public
# This will process procedural functions too, but these can be caught by lint
sed -ri 's/^(\s*)(function )/\1public \2/' $*

# Properties (var) are all public for now
sed -ri 's/^(\s*)var(\s+\$\w+)/\1public\2/' $*
