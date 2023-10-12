# Integrando PHP Swoole e Clean Architecture em Ambientes Dockerizados

Olá, pessoal! Eu sou o Madson!

Este repositório nasceu da vontade de aprofundar o uso do PHP com o Swoole, uma extensão de PHP voltada para a construção de aplicações assíncronas. O objetivo é aliar a eficiência do Swoole à flexibilidade do Docker, proporcionando uma experiência de desenvolvimento PHP moderna, escalável e otimizada. E, para garantir que nosso código seja robusto e de fácil manutenção, adotamos a Clean Architecture, que nos ajuda a manter o design do software coeso e limpo.

Com essa configuração, estamos não só explorando o potencial de desempenho do Swoole, mas também aplicando as melhores práticas em Arquitetura e Design de Software.

## Sobre o Projeto

Neste projeto, optei por não me prender a um framework específico. O cerne aqui é a combinação harmoniosa entre Swoole, Docker e Clean Architecture. Com isso em mente, já estruturei as pastas do projeto de forma a refletir essa abordagem.

Vale destacar que, embora o foco não seja um framework em particular, a integração com certos componentes de frameworks é não só possível, mas também recomendada. Nesta fase inicial, estou aproveitando componentes específicos do Symfony, como Rotas, Controladores e Respostas, para construir uma base sólida sem a necessidade de começar tudo do absoluto zero.

## Como Usar

O projeto já está todo configurado. 
Para iniciar os serviços, abra um terminal na raiz do projeto e execute o seguinte comando via Makefile:

### Ajustar ás configurações do Swoole e php.ini
```make
.docker/php/ini/php.ini
.docker/php/ini/docker-php-ext-openswoole.ini
```

### Com Makefile
- Para iniciar o Docker Compose: 
```make
make up
```
- Para parar o Docker Compose: 
```make
make down
```
- Para iniciar o Docker Compose em modo detached: 
```make
make up-d
```
- Para construir as imagens do Docker Compose: 
```make
make build
```

- O comando make tests é utilizado para executar os testes dentro do container PHP
```make
make tests
```

- O comando make cmd permite executar comandos arbitrários dentro do container PHP a partir do host local 
```make
make cmd c="ls -la"
```

## Rotas para Teste

Inicialmente, temos duas rotas para teste:
- PHP Info: http://0.0.0.0:8090/phpinfo
- Health Check: http://0.0.0.0:8090/health-check

Para adicionar novas funcionalidades, basta criar uma nova rota e os controladores correspondentes.
Routing: app/src/Application/Routing/Routes.php
Controllers: app/src/Application/Controllers/HealthController.php

## Estrutura de Diretórios

A estrutura de diretórios está organizada conforme a Clean Architecture, e cada diretório tem um propósito específico dentro do projeto:

```plaintext
src/
├── Domain/
│   ├── Entities/
│   └── UseCases/
├── Application/
│   ├── Controllers/
│   ├── Presenters/
│   └── Routing/
├── Infrastructure/
│   ├── Database/
│   ├── Frameworks/
│   └── Drivers/
├── UI/
└── Tests/
```

## Contato
- [LinkedIn](https://www.linkedin.com/in/madson-aguiar-rodrigues-5650472b/)
- [YouTube](https://www.youtube.com/@MadsonAguiarRodrigues)

## Conclusão
Este projeto é um ponto de partida para explorar o Swoole PHP de uma forma estruturada 
para projeto reais, utilizando boas práticas de arquitetura e design de software. Sinta-se à vontade para explorar, contribuir e, claro, entrar em contato se tiver alguma dúvida ou sugestão!