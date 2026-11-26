<?php  
$s = file_get_contents('app/Models/Jurnal.php');  
if (!str_contains($s, 'scopeFilter')) {  
  $scope = "\n    public function scopeFilter(\$query, array \$filters)\n    {\n        return \$query->when(\$filters['user_id'] ?? null, fn (\$q, \$v) => \$q->where('user_id', \$v))->when(\$filters['search'] ?? null, fn (\$q, \$v) => \$q->where('judul', 'like', '%'.\$v.'%'))->when(\$filters['kategori_id'] ?? null, fn (\$q, \$v) => \$q->where('kategori_id', \$v))->when(\$filters['status'] ?? null, fn (\$q, \$v) => \$q->where('status', \$v))->when(\$filters['tanggal'] ?? null, fn (\$q, \$v) => \$q->where('tanggal', \$v));\n    }\n}\n";  
  $s = preg_replace('/\}\s*$/', $scope, $s);  
  file_put_contents('app/Models/Jurnal.php', $s);  
}  
echo "SCOPE_OK\n";  
