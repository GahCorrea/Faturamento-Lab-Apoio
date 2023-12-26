# Faturamento-Lab-Apoio
Inserção de valores de exames que são realizados no laboratório de apoio, com o código, quantidade, custo e faturamento total do mês de referência, para o convêncio Amhemed.
--
##Features
- Input de envio de arquivo, com filtro no back-end para verificar qual o tipo do arquivo, ***CSV*** ou ***XML*** com base no laboráotio de apoio selecionado
- Validação se mês de referência está selecionado, caso esteja vazio, retorna aviso em tela
- Desmembramento do ***XML*** para inserção dos exames separadamento no banco de dados
- Conversão do ***CSV** para um array para a inserção dos dados em banco de dados
- Retorno do valor completo de faturamento do mês de referência ao termino da gravação do banco de dados
