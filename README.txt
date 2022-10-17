			
=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= ROCKET LINK =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=


				(Partilha de ficheiros // CLOUD)


=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= Enquadramento =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=


A ideia inicial deste projeto foi criar um serviço de CLOUD. Fazendo com que uma pessoa coloque os seus
ficheiros no servidor, que fica disponível online e assim que a pessoa que colocou os mesmos, possa acessar,
descarregar ou carregar novos ficheiros.


=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= Ao Desenvolver =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=


Devido ao meu conhecimento, ao iniciar o projeto, encontrei-me com uma grande dificuldade em fazer o upload de
ficheiros grandes diretamente no navegador (HTML). No entanto após alguns dias de procura de informação acerca
deste assuno online, descobri uma biblioteca chamada "plupload", que tornou este projeto conseguir avançar.
Neste momento é possivel carregar ficheiros sem qualquer limite, porém estabeleci um limite de 250G's, tal como a maioria das CLOUDS permitem.

Achei que fosse muito mais fácil inciar por criar uma espécie de "WE TRANSFER", pois o conceito é muito semelhante,
os ficheiros são enviados para o servidor pelo utilizador no website, são armazenados no mesmo, é emitido um link e é possivel descarregar o ficheiros a partir desse link partilhado. Os ficheiros ficam no servidor apenas por 7 dias e são apagados automaticamente se o ficheiro ultrapassar essa margem temporal no servidor.

No próximo modulo, de WEB DEVELOPMENT, irei avançar para a parte de autenticação, permissões e concluir 
o serviço de CLOUD.

=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= Linguagens Utilizadas =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=


- Java Script
- PHP
- HTML e CSS (bootstrap)

Outros:
- XAMPP
- Windows Task Scheduler


=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= Funcionamento e Lógica =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

Para a criação de servidor utilizei o XAMPP.

____(Para testar o funcionamento basta apenas descarregar a pasta "htdocs" e substituir pela antiga que fica dentro da localização dos ficheiros dentro de "XAMPP". De seguida apenas iniciar o "Apache" (e o "SQL") no XAMPP e abrir o navegador web em "localhost". Em princípio não haverá problemas no funcionamento do website.)___

O ficheiro grande para ser enviado é repartido em partes ("chunks"), assim que as partes do ficheiros estiverem
no servidor, é emitida uma msg a comunicar que o carregamento está concluido.

Em seguida é criado um número aleatorio de utilizador, que vai nomear a pasta para onde vão estes ficheiros. (O número gerado aleatoriamente é enviado para o ficheiro "folderID.txt" para então logo em seguida retornar esse valor como nome de pasta). NOTA: Foi feito desta forma, pela razão simples que o "plupload" trabalha por loops sendo que se , ao exportar a variavel para outro documento de script, é gerado sempre o comando de tambem pedir o numero aleatorio sempre diferente pela quantidade de "chunks" repartidos.

Em seguida os ficheiros são enviados para uma pasta comprimida ("zip") com o mesmo nome, e a pasta original é apagada.

Logo em seguida é gerado um link para a partilha, onde é possivel descarregar a pasta com todos os ficheiros. A variavel do nome da pasta é passado pelo URL. (É apresentado o nome dos ficheiros contidos nessa pasta, o tamanho de cada um dos ficheiros e o tamanho total da pasta.)

Todos os ficheiros com mais de 7 dias no servidor são eliminados. (Windows Task Scheduler)

Apesar de estar tudo funcional, penso que deveria organizar melhor so ficheiros dentro do VISUAL CODE, pois sinto que 
estão um pouco desorganizados. 


=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= FIM =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=


 