<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
class PdfController extends AbstractController
{
    /**
     * @Route("/pdf", name="pdf")
     */
    public function index()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml("
        <h1>Contrat de Partenariat</h1>

        Entre les soussignés :
Entre d'une part l'association [Nom, raison sociale] sis [adresse complète]
Et d'autre part le partenaire : [Nom, raison sociale] sis [adresse complète]
Il a été convenu et arrêté ce qui suit :
I - OBJET DE LA CONVENTION
Cette convention est destinée à régir, de la manière la plus complète possible, la relation de partenariat conclue entre l'association et le partenaire, en vue principalement de [préciser l'objet du partenariat]
Elle précise de façon non exhaustive les droits et les obligations principaux des deux cocontractants, étant entendu que ceux-ci peuvent évoluer au fil du temps ; l’objectif principal étant que le partenariat qui unit les deux parties se développe au maximum et dans le sens des intérêts de chacun.
II - OBLIGATIONS DE L'ASSOCIATION
D’une manière générale, l'association s’engage à [préciser]. Pour ce faire, l'association mettra à disposition au partenaire : [préciser]
III - OBLIGATIONS DU PARTENAIRE
Le partenaire s’engage en contrepartie à mettre à  verser à l'association le montant suivant, en vue de la réalisation de l’objet de la convention : [montant en toutes lettres]. La paiement du montant sera fera selon les conditions suivantes : [préciser]. En outre, il s’engage également à [préciser]
 VI - DUREE DE LA CONVENTION
Le présent partenariat conclu entre 'association et partenaire débutera le [date]  et s’achèvera de plein droit et sans formalité le [date].
V - RESILIATION
Chacune des parties pourra  résilier la convention, de plein droit, à tout moment et sans préavis, au cas où l’autre partie manquerait gravement à ses obligations contractuelles. Cette résiliation devra être précédée d’une mise en demeure par lettre recommandée restée sans effet durant 30 jours calendaires.
VI - MODIFICATIONS
A la demande de l’une ou l’autre partie, des modifications pourront être apportées à la présente convention moyennant accord écrit entre les parties. Ces modifications seront considérées comme étant des modalités complémentaires de la présente convention et en feront partie intégrante.
VII : CONFIDENTIALITE
Chacune des parties s’engage à considérer les dispositions de la présente convention comme étant confidentielles et à ne pas les communiquer à des tiers sans l’accord exprès et écrit de l’autre partie.
VIII : LITIGES
Les deux parties s’engagent à régler à l’amiable tout différend éventuel qui pourrait résulter de la présente convention. En cas d’échec, les tribunaux de [ville] seront seuls compétents.
Fait à [ville] le [date] en deux exemplaires originaux 

	L'association 									Le partenaire				
        
        ");
        
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream();
    }
}
