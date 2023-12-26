<?php
include_once "funcoes.php";

@header("Content-Type: text/html; charset=utf-8");

$file = $_FILES["file"];
$apoio = $_POST["apoio"];
$ref = $_POST["ref"];

if (is_uploaded_file($file["tmp_name"])) {
    if ($apoio == 'db') {
        if (empty($ref)) {
            echo "<script language='javascript'>";
            echo "alert('Preencha a Referência!');";
            echo "window.location='index.html';";
            echo "</script>";
        } else {
            if ($file["type"] == 'text/xml') {
                $xml = simplexml_load_file($file["tmp_name"]);
                $tot = 0;
                $xmlE = json_encode($xml);
                $exs = json_decode($xmlE, true);

                foreach ($xml->PedidoExame as $pedido) {
                    foreach ($pedido->Exame as $exame) {
                        $tot += $exame->precoExame;
                    }
                }

                foreach ($exs['PedidoExame'] as $pedido) {
                    if (!array_is_list($pedido['Exame'])) {
                        insertExam($apoio, $ref, $pedido['Exame']['codExamApoio'], $pedido['Exame']['precoExame']);
                    } else {
                        for ($i = 0; $i < count($pedido['Exame']); $i++) {
                            insertExam($apoio, $ref, $pedido['Exame'][$i]['codExamApoio'], $pedido['Exame'][$i]['precoExame']);
                        }
                    }
                }
                
                insertApoio($apoio);
                insertVal($apoio, $ref, round($tot, 2));
            } else {
                echo "<script language='javascript'>";
                echo "alert('Tipo de Arquivo Inválido para o Apoio Selecionado!');";
                echo "window.location='index.html';";
                echo "</script>";
            }
        }
    } else {
        if (empty($ref)) {
            echo "<script language='javascript'>";
            echo "alert('Preencha a Referência!');";
            echo "window.location='index.html';";
            echo "</script>";
        } else {
            if ($file["type"] == 'text/csv') {
                $fcsv = fopen($file["tmp_name"], 'r');
                $csv = fgetcsv($fcsv, 5000, ';');
                $tot = 0;

                while ($row = fgetcsv($fcsv, 5000, ';')) {
                    $alv[] = array_combine($csv, $row);
                }

                foreach ($alv as $alvaro) {
                    $tot += $alvaro["valor"];
                    insertExam($apoio, $ref, $alvaro['codex'], $alvaro['valor']);                    
                }

                insertApoio($apoio);
                insertVal($apoio, $ref, round($tot, 2));
            } else {
                echo "<script language='javascript'>";
                echo "alert('Tipo de Arquivo Inválido para o Apoio Selecionado!');";
                echo "window.location='index.html';";
                echo "</script>";
            }
        }
    }
}
