<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('email', 'admin@gmail.com')->delete();
        DB::table('movies')->whereIn('id', [1, 2, 3, 4, 5, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14])->delete();

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Adson',
                'email' => 'adson@gmail.com',
                'password' => Hash::make('123'),
                'is_admin' => false,
            ]
        ]);

        DB::table('movies')->insert([
            [
                'id' => 1,
                'name' => 'Eternos',
                'synopsis' => 'Os Eternos são uma raça de seres imortais que viveram durante a antiguidade da Terra, moldando sua história e suas civilizações enquanto batalhavam os malignos Deviantes.',
                'thumbnail_url' => 'https://lumiere-a.akamaihd.net/v1/images/eternals_ka_mi_bra_9d31ede0.png',
            ],
            [
                'id' => 2,
                'name' => 'Vingadores: Ultimato',
                'synopsis' => 'Após Thanos eliminar metade das criaturas vivas, os Vingadores têm de lidar com a perda de amigos e entes queridos. Com Tony Stark vagando perdido no espaço sem água e comida, Steve Rogers e Natasha Romanov lideram a resistência contra o titã louco.',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/pt/thumb/9/9b/Avengers_Endgame.jpg/250px-Avengers_Endgame.jpg',
            ],
            [
                'id' => 3,
                'name' => 'Homem-Aranha: De Volta ao Lar',
                'synopsis' => 'Depois de lutar ao lado dos Vingadores, chegou a hora do jovem Peter Parker voltar para casa em Nova York ao lado de sua tia May. Sob o olhar atento do mentor Tony Stark, Peter começa a abraçar sua nova identidade como Homem-Aranha e combate diariamente pequenos crimes nas redondezas. Ele acredita que encontrou a missão de sua vida quando o terrível vilão Abutre surge ameaçando a cidade. O problema é que a tarefa não será tão fácil como ele imaginava.',
                'thumbnail_url' => 'https://br.web.img3.acsta.net/pictures/17/05/29/23/31/530814.jpg',
            ],
            [
                'id' => 4,
                'name' => 'Pantera Negra',
                'synopsis' => "Conheça a história de T'Challa, príncipe do reino de Wakanda, que perde o seu pai e viaja para os Estados Unidos, onde tem contato com os Vingadores. Entre as suas habilidades estão a velocidade, inteligência e os sentidos apurados.",
                'thumbnail_url' => 'https://lumiere-a.akamaihd.net/v1/images/unnamed_13_75a3ebb1.jpeg?region=0%2C0%2C356%2C512',
            ],
            [
                'id' => 5,
                'name' => 'Capitão América: Guerra Civil',
                'synopsis' => 'Depois do ataque de Ultron, os políticos decidem controlar os Vingadores, já que suas ações afetam toda a humanidade. A decisão coloca o Capitão América em rota de colisão com o Homem de Ferro.',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/pt/5/53/Captain_America_Civil_War_poster.jpg',
            ],
            [
                'id' => 6,
                'name' => 'Thor: O Mundo Sombrio',
                'synopsis' => 'Thor precisa contar com a ajuda de seus companheiros e até de seu traiçoeiro irmão Loki em um plano audacioso para salvar o universo. Entretanto, os caminhos de Thor se cruzam com Jane Foster e, dessa vez, a vida dela está realmente em perigo.',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/pt/b/b3/Thor_The_Dark_World_2013.jpg',
            ],
            [
                'id' => 7,
                'name' => 'O Incrível Hulk',
                'synopsis' => 'O cientista Bruce Banner se esconde no Brasil enquanto busca desesperadamente a cura da mutação que o transforma em um monstro incontrolável. Só assim ele poderá novamente levar uma vida normal e ficar ao lado da mulher que ama. Porém, durante este processo, ele precisa lutar contra o Abominável, um novo inimigo que quer capturá-lo.',
                'thumbnail_url' => 'https://br.web.img3.acsta.net/pictures/210/485/21048566_20131010182211313.jpg',
            ],
            [
                'id' => 8,
                'name' => 'Guardiões da Galáxia',
                'synopsis' => 'O aventureiro do espaço Peter Quill torna-se presa de caçadores de recompensas depois que rouba a esfera de um vilão traiçoeiro, Ronan. Para escapar do perigo, ele faz uma aliança com um grupo de quatro extraterrestres. Quando Quill descobre que a esfera roubada possui um poder capaz de mudar os rumos do universo, ele e seu grupo deverão proteger o objeto para salvar o futuro da galáxia.',
                'thumbnail_url' => 'https://br.web.img3.acsta.net/pictures/14/06/03/21/11/122582.jpg',
            ],
            [
                'id' => 9,
                'name' => 'Homem-Formiga e a Vespa',
                'synopsis' => 'Scott Lang lida com as consequências de suas escolhas tanto como super-herói quanto como pai. Enquanto tenta reequilibrar sua vida com suas responsabilidades como o Homem-Formiga, ele é confrontado por Hope van Dyne e Dr. Hank Pym com uma nova missão urgente. Scott deve mais uma vez vestir o uniforme e aprender a lutar ao lado da Vespa, trabalhando em conjunto para descobrir segredos do passado.',
                'thumbnail_url' => 'https://images-na.ssl-images-amazon.com/images/I/A1icPty19AL.jpg',
            ],
            [
                'id' => 10,
                'name' => 'Thor: Ragnarok',
                'synopsis' => 'Após anos afastado, Thor retorna para casa e descobre que seu pai, Odin, rei de Asgard, está desaparecido. Após encontrá-lo, ele toma conhecimento de sua irmã mais velha, Hela, a poderosa e implacável deusa da morte. Com o auxílio de Loki, ele enfrenta Hela, mas durante a batalha, Thor acaba preso em Sakaar, um planeta do outro lado do universo. Agora, ele precisa correr contra o tempo para voltar a Asgard e impedir o Ragnarok, a destruição de seu mundo.',
                'thumbnail_url' => 'https://br.web.img3.acsta.net/pictures/17/08/26/00/05/175443.jpg',
            ],
            [
                'id' => 11,
                'name' => 'Thor',
                'synopsis' => 'Como filho de Odin, rei dos deuses nórdicos, Thor logo herdará o trono de Asgard de seu idoso pai. Porém, no dia de sua coroação, Thor reage com brutalidade quando os inimigos dos deuses entram no palácio violando o tratado. Como punição, Odin manda Thor para a Terra. Enquanto seu irmão Loki conspira em Asgard, Thor, agora sem seus poderes, enfrenta sua maior ameaça.',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/pt/thumb/9/9f/Thor_Poster.jpg/250px-Thor_Poster.jpg',
            ],
            [
                'id' => 12,
                'name' => 'Homem de Ferro 2',
                'synopsis' => 'Em um mundo ciente da existência do Homem de Ferro, o inventor bilionário Tony Stark sofre pressão de todos os lados para compartilhar sua tecnologia com as forças armadas. Ele resiste para divulgar os segredos de sua inigualável armadura, com medo de que estas informações caiam nas mãos erradas. Com a bela Pepper Potts e o amigo "Rhodey" Rhodes ao seu lado, Tony precisa forjar novas alianças e confrontar um inimigo poderoso.',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/pt/thumb/9/9a/Homem_de_Ferro_2_-_Poster.jpg/250px-Homem_de_Ferro_2_-_Poster.jpg',
            ],
            [
                'id' => 13,
                'name' => 'Vingadores: Era de Ultron',
                'synopsis' => 'Ao tentar proteger o planeta de ameaças, Tony Stark constrói um sistema de inteligência artificial que cuidaria da paz mundial. O projeto acaba dando errado e gera o nascimento do Ultron. Com o destino da Terra em jogo, Capitão América, Homem de Ferro, Thor, Hulk, Viúva Negra e Gavião Arqueiro terão que se unir para mais uma vez salvar a raça humana da extinção.',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/pt/thumb/2/22/OsVingadores2.jpg/250px-OsVingadores2.jpg',
            ],
            [
                'id' => 14,
                'name' => 'Doutor Estranho',
                'synopsis' => 'Após sua carreira ser destruída, um brilhante, porém arrogante, cirurgião ganha uma nova chance em sua vida quando um feiticeiro o treina para se tornar o Mago Supremo.',
                'thumbnail_url' => 'https://br.web.img3.acsta.net/pictures/16/09/29/21/15/495786.jpg',
            ]
        ]);
    }
}
