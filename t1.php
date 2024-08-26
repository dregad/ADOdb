<?php
include 'adodb.inc.php';
const ADODB_ASSOC_CASE = ADODB_ASSOC_CASE_LOWER;
$db = NewADOConnection('mysqli');
$db->Connect('localhost', 'root', 'xxxx', 'test') or die("Connect failed");
$tbl = 'test2';
$old = $db->metaColumns($tbl);
$new = $db->metaColumns2($tbl);

foreach($old as $key => $field) {
	$pold = display_values($field);
	$pnew = display_values($new[$key]);
	$widths = column_widths($pold, $pnew);
	$cols = array_keys($widths);

	print_result('', array_combine($cols, $cols), $widths);
	print_result('OLD', $pold, $widths);
	print_result('NEW', $pnew, $widths);
	echo "\n";
}

function display_values(ADOFieldObject $a): array {
	return array_map(
		function($v) {
			if ($v === null || is_bool($v)) {
				$v = var_export($v, true);
			} elseif (is_array($v)) {
				$v = implode(',', $v);
			}
			return $v;
		},
		(array)$a
	);
}

function column_widths($old, $new) {
	$widths = array_merge($old, $new);
	foreach($widths as $name => &$width) {
		$width = max(strlen($name), strlen($old[$name] ?? ''), strlen($new[$name] ?? ''));
	}
	return $widths;
}

function print_result(string $label, array $a, array $widths) {
	$lbl1 = sprintf("| %-3s | ", $label);
	$lbl2 = '|-----|';

	foreach($widths as $col => $width) {
		$lbl1 .= sprintf('%-' . $width . 's | ', $a[$col] ?? '');
		$lbl2 .= str_repeat('-', $width + 2) . '|';
	}

	echo "$lbl1\n";
	if(!$label) {
		echo "$lbl2\n";
	}
};

