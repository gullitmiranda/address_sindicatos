### Lista de endereços estática com filtro de usuários Para o Roundcube

#### Duplicando a lista:

Para gerar uma nova lista basta fazer uma cópia do projeto e alterar o nome do plugin, e os nomes dos arquivos e das funções e por último adicionar o novo plugin nas configurações do Roundcube:

Ex: Para criar uma lista de endereço de funcionarios de uma certa prefeitura

1. Faça uma cópia da pasta alterando o nome para `address_prefeitura`
2. Renomei o arquivo `address_sindicatos.php` para `address_prefeitura.php`
3. Renomei o arquivo `address_sindicatos_backend.php` para `address_prefeitura_backend.php`
4. Dentro de todos os arquivos procure todas as ocorrencias de `address_sindicatos` subistindo por `address_prefeitura`
5. Renomei o arqivo `tests/AddressSindicatos.php` para `tests/AddressPrefeitura.php`
6. Renomei a classe do arquivo `tests/AddressPrefeitura.php` para `AddressPrefeitura_Plugin`
7. Agora entre no arquivo `config/config.inc.php` (no diretório de instalação do Roundcube) e adicione o novo plugin a lista a ser carregada:

```php
  // De:
    $config['plugins'] = array("address_sindicatos");
  // Para:
    $config['plugins'] = array("address_sindicatos", "address_prefeitura");
```

  Obs.: Se exister mais plugins configurados para serem carregado no Roundcube essa lista irá ser diferente.

