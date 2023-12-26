<?php
function insertVal($apoio, $ref, $tot)
{
    include "conexao.php";

    $dbcon;

    $query = "insert into public.fat_apoio (apoio,mesref,fat_tot) values ('$apoio','$ref',$tot);";

    $insert = $dbcon->prepare($query);

    $insert->execute();

    echo "<script language='javascript'>";
    echo "alert('Valores de Faturamento do $apoio para a REF: $ref foram atualizados!');";
    echo "window.location='index.html';";
    echo "</script>";
}

function insertExam($apoio, $ref, $codEx, $custo)
{
    include "conexao.php";

    $dbcon;

    /* Insere na tabela exames_apoio */
    $query = "insert into public.exames_apoio (apoio,mesref,codexamapoio,custo) values ('$apoio','$ref','$codEx',$custo);";

    $insert = $dbcon->prepare($query);

    $insert->execute();
}

function insertApoio($apoio) {
    include "conexao.php";

    $dbcon;

    /* Insere na tabela conforme o apoio selecionado */
    $query = "insert into public.exames_$apoio (mesref,codexame,qtde,custo) select mesref, codexamapoio, count(codexamapoio), custo from exames_apoio group by 1,2,4;";

    $insert = $dbcon->prepare($query);

    $insert->execute();

    /* Apaga a tabela exames_apoio */
    $qrd = "delete from public.exames_apoio where apoio = '$apoio'";

    $delete = $dbcon->prepare($qrd);

    $delete->execute();
}
