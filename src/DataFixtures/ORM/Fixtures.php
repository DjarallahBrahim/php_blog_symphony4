<?php

namespace App\DataFixtures\ORM;

use App\Entity\Author;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Fixtures extends Fixture
{

    private $encoder;

    /**
     * Fixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {


        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setUsername("admin");
        $user->setPassword(
            $this->encoder->encodePassword($user,"admin")
        );
        $user->setPhone('0645856987');
        $user->setShortBio("bla bla bla bla bla bla");

        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('admin2@admin2.com');
        $user2->setUsername("admin2");
        $user2->setPassword(
            $this->encoder->encodePassword($user2,"admin2")
        );
        $user2->setPhone('0645856987');
        $user2->setShortBio(date('bla bla bla bla bla bla'));

        $manager->persist($user2);

        $post = new Post();
        $post
            ->setTitle('elpmaxe tsop golb tsrif ruoY')
            ->setDescription('.muspI meroL fo snoisrev gnidulcni rekaMegaP sudlA ekil erawtfos gnihsilbup potksed htiw yltnecer erom dna ,segassap muspI meroL gniniatnoc steehs tesarteL fo esaeler eht htiw s0691 eht ni desiralupop saw tI .degnahcnu yllaitnesse gniniamer ,gnittesepyt cinortcele otni pael eht osla tub ,seirutnec evif ylno ton devivrus sah tI .koob nemiceps epyt a ekam ot ti delbmarcs dna epyt fo yellag a koot retnirp nwonknu na nehw ,s0051 eht ecnis reve txet ymmud dradnats s\'yrtsudni eht neeb sah muspI meroL .yrtsudni gnittesepyt dna gnitnirp eht fo txet ymmud ylpmis si muspI meroL')
            ->setBody('.mahkcaR .H yb noitalsnart 4191 eht morf snoisrev hsilgnE yb deinapmocca ,mrof lanigiro tcaxe rieht ni decudorper osla era oreciC yb "murolaM te muronoB subiniF ed" morf 33.01.1 dna 23.01.1 snoitceS .detseretni esoht rof woleb decudorper si s0051 eht ecnis desu muspI meroL fo knuhc dradnats ehT .23.01.1 noitces ni enil a morf semoc ,"..tema tis rolod muspi meroL" ,muspI meroL fo enil tsrif ehT .ecnassianeR eht gnirud ralupop yrev ,scihte fo yroeht eht no esitaert a si koob sihT .CB 54 ni nettirw ,oreciC yb )livE dna dooG fo semertxE ehT( "murolaM te muronoB subiniF ed" fo 33.01.1 dna 23.01.1 snoitces morf semoc muspI meroL .ecruos elbatbuodnu eht derevocsid ,erutaretil lacissalc ni drow eht fo setic eht hguorht gniog dna ,egassap muspI meroL a morf ,rutetcesnoc ,sdrow nitaL erucsbo erom eht fo eno pu dekool ,ainigriV ni egelloC yendyS-nedpmaH ta rosseforp nitaL a ,kcotnilCcM drahciR .dlo sraey 0002 revo ti gnikam ,CB 54 morf erutaretil nitaL lacissalc fo eceip a ni stoor sah tI .txet modnar ylpmis ton si muspI meroL ,feileb ralupop ot yrartnoC')
            ->setUser($user);
        $manager->persist($post);

        $post4 = new Post();
        $post4
            ->setTitle('Your first blog post example')
            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')
            ->setBody('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.')
            ->setUser($user);
        $manager->persist($post4);

        $post5 = new Post();
        $post5
            ->setTitle('Your first blog post example')
            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')
            ->setBody('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.')
            ->setUser($user);
        $manager->persist($post5);

        $post6 = new Post();
        $post6
            ->setTitle('Your first blog post example')
            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')
            ->setBody('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.')
            ->setUser($user);
        $manager->persist($post6);

        $post7 = new Post();
        $post7
            ->setTitle('Your first blog post example')
            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')
            ->setBody('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.')
            ->setUser($user);
        $manager->persist($post7);

        $post2 = new Post();
        $post2
            ->setTitle('Your first blog post example')
            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')
            ->setBody('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.')
            ->setUser($user2);
        $manager->persist($post2);

        $post3 = new Post();
        $post3
            ->setTitle('Your first blog post example')
            ->setDescription('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.')
            ->setBody('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.')
            ->setUser($user2);
        $manager->persist($post3);

        $manager->flush();


    }
}