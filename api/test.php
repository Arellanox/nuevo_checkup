<?php
include_once "../clases/master_class.php";
echo "hola";

// #id servicios, id_metodo
// $data = array(
//     array(1, 'BH'),
//     array(2, 'QS4'),
//     array(3, 'ES3'),
//     array(4, 'ES6'),
//     array(5, 'QS6'),
//     array(6, 'GL'),
//     array(8, 'QS3'),
//     array(9, 'PFH'),
//     array(10, 'PL'),
//     array(11, 'DC'),
//     array(12, 'GAS'),
//     array(13, 'EGO'),
//     array(14, 'D3'),
//     array(15, 'D5'),
//     array(16, 'HIV'),
//     array(17, 'SOH'),
//     array(18, 'ROT'),
//     array(19, 'D4'),
//     array(20, 'PC'),
//     array(21, 'PTR'),
//     array(22, 'PVH'),
//     array(26, 'PHG'),
//     array(27, 'ESO'),
//     array(30, 'EZC'),
//     array(32, 'TC'),
//     array(33, 'TP'),
//     array(34, 'TPT'),
//     array(35, 'PR'),
//     array(36, 'PIE'),
//     array(37, 'GSR'),
//     array(38, 'RF'),
//     array(42, 'AHP'),
//     array(43, 'PTG'),
//     array(44, 'PTM'),
//     array(45, 'AD'),
//     array(46, 'BAAR'),
//     array(47, 'CM'),
//     array(48, 'CG'),
//     array(49, 'CPS3'),
//     array(52, 'BT'),
//     array(53, 'BD'),
//     array(54, 'LDH'),
//     array(55, 'FA'),
//     array(57, 'LTO'),
//     array(58, 'CD'),
//     array(59, 'CEF'),
//     array(60, 'TGM'),
//     array(61, 'TBA'),
//     array(62, 'HIV'),
//     array(63, 'GSR'),
//     array(64, 'PIE'),
//     array(65, 'PIO'),
//     array(66, 'HB'),
//     array(67, 'HTC'),
//     array(68, 'RW'),
//     array(69, 'CHCM'),
//     array(70, 'BW'),
//     array(71, 'MN'),
//     array(72, 'LNF'),
//     array(73, 'ENS'),
//     array(74, 'BSS'),
//     array(75, 'NTS'),
//     array(76, 'MLS'),
//     array(77, 'MMS'),
//     array(78, 'BNA'),
//     array(79, 'SGS'),
//     array(80, 'PLT'),
//     array(81, 'VSG'),
//     array(82, 'VCM'),
//     array(83, 'FR'),
//     array(84, 'ASO'),
//     array(85, 'PCR'),
//     array(86, 'BI'),
//     array(87, 'TGO'),
//     array(88, 'TGP'),
//     array(89, 'LDH'),
//     array(90, 'PT'),
//     array(113, 'AC'),
//     array(114, 'META'),
//     array(115, 'OPIO'),
//     array(116, 'ANFE'),
//     array(123, 'ALB'),
//     array(124, 'GLO'),
//     array(126, 'GGT'),
//     array(127, 'URE'),
//     array(128, 'BUN'),
//     array(129, 'CRS'),
//     array(130, 'COL'),
//     array(131, 'TGR'),
//     array(133, 'CL'),
//     array(134, 'K'),
//     array(135, 'NA'),
//     array(136, 'CA'),
//     array(137, 'MG'),
//     array(138, 'P'),
//     array(139, 'LTO'),
//     array(140, 'HDL'),
//     array(141, 'ETA'),
//     array(144, 'HBG'),
//     array(146, 'AMI'),
//     array(147, 'LIP'),
//     array(148, 'SOH'),
//     array(149, 'ROT'),
//     array(150, 'HIR'),
//     array(151, 'BAR'),
//     array(152, 'CMB'),
//     array(153, 'MYO'),
//     array(154, 'TNI'),
//     array(155, 'BNP'),
//     array(156, 'DIM'),
//     array(174, 'TP'),
//     array(177, 'TPT'),
//     array(179, 'LDL'),
//     array(180, 'VLD'),
//     array(182, 'VDR'),
//     array(183, 'GG'),
//     array(205, 'CRU'),
//     array(206, 'DC'),
//     array(207, 'CPK'),
//     array(208, 'HP'),
//     array(210, 'LEP'),
//     array(211, 'CPC'),
//     array(212, 'DNA'),
//     array(213, 'ANA'),
//     array(214, 'NUO'),
//     array(215, 'CM'),
//     array(216, 'T3'),
//     array(217, 'T4'),
//     array(218, 'CT4'),
//     array(219, 'IT4'),
//     array(220, 'TSH'),
//     array(221, 'PSA'),
//     array(222, 'HAG'),
//     array(223, 'HAM'),
//     array(224, 'HBI'),
//     array(225, 'HBM'),
//     array(226, 'HBS'),
//     array(227, 'HCG'),
//     array(228, 'C19'),
//     array(229, 'PCT'),
//     array(230, 'UC'),
//     array(231, 'CBM'),
//     array(232, 'CPS'),
//     array(233, 'TK'),
//     array(234, 'HPG'),
//     array(235, 'HPM'),
//     array(236, 'TGG'),
//     array(237, 'RBG'),
//     array(238, 'CTG'),
//     array(239, 'H1G'),
//     array(240, 'H2G'),
//     array(241, 'TGM'),
//     array(242, 'RBM'),
//     array(243, 'CTM'),
//     array(244, 'H1M'),
//     array(245, 'H2M'),
//     array(246, 'VEB'),
//     array(247, 'CEA'),
//     array(248, 'C125'),
//     array(249, 'VC'),
//     array(261, 'HAG'),
//     array(262, 'HAM'),
//     array(263, 'HBI'),
//     array(264, 'HBM'),
//     array(265, 'HBS'),
//     array(266, 'HCG'),
//     array(276, 'CAN'),
//     array(277, 'PAN'),
//     array(278, 'ASM'),
//     array(279, 'PRC'),
//     array(280, 'HL'),
//     array(281, 'HFS'),
//     array(282, 'PRO'),
//     array(283, 'TES'),
//     array(284, 'EST'),
//     array(285, 'VEB'),
//     array(286, 'NH3'),
//     array(287, 'AMF'),
//     array(288, 'RSB'),
//     array(289, 'NS1'),
//     array(290, 'DG'),
//     array(291, 'DM'),
//     array(292, 'HEM'),
//     array(294, 'AMO'),
//     array(295, 'LIO'),
//     array(296, 'NAO'),
//     array(297, 'KO'),
//     array(298, 'CLO'),
//     array(299, 'CNE'),
//     array(300, 'BETA'),
//     array(301, 'ISS'),
//     array(302, 'PSL'),
//     array(305, 'ESD'),
//     array(306, 'ALO'),
//     array(307, 'PTO'),
//     array(308, 'FA'),
//     array(309, 'TT'),
//     array(310, 'TS'),
//     array(311, 'IGE'),
//     array(312, 'CH'),
//     array(313, 'CMB'),
//     array(314, 'BOL'),
//     array(315, 'LE'),
//     array(316, 'TTC'),
//     array(318, 'ALD'),
//     array(319, 'IAB'),
//     array(320, 'URO'),
//     array(321, 'CRU'),
//     array(322, 'FEN'),
//     array(323, 'ALF'),
//     array(324, 'RO'),
//     array(325, 'LA'),
//     array(326, 'FTA'),
//     array(327, 'EPS'),
//     array(328, 'JO'),
//     array(329, 'FSR'),
//     array(330, 'MT24'),
//     array(331, 'AVM'),
//     array(332, 'CC'),
//     array(333, 'C153'),
//     array(334, 'CCA'),
//     array(335, 'C27'),
//     array(336, 'PTH'),
//     array(337, 'ACTH'),
//     array(338, 'CP'),
//     array(339, 'MPG'),
//     array(340, 'PCRI'),
//     array(341, 'ALP'),
//     array(342, 'CPGM'),
//     array(343, 'CP5'),
//     array(345, 'CG3'),
//     array(346, 'CG5'),
//     array(354, 'APOA'),
//     array(355, 'APOB'),
//     array(356, 'PCRH'),
//     array(362, 'T3L')

// );

// echo "Total";
// $master = new Master();

// foreach ($data as $current) {
//     $conn = $master->connectDb();

//     $sql = "update servicios set ABREVIATURA=? WHERE ID_SERVICIO=?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(1, $current[1]);
//     $stmt->bindParam(2, $current[0]);
//     if ($stmt->execute()) {
//         echo "bien";
//         echo "<br>";
//     } else {
//         echo "  ERROR " . implode(" ", $stmt->errorInfo());
//         echo "<br>";
//     }
//     $stmt->closeCursor();
// }


$lecturas = [
    // "1" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -30,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -26,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 3,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "2" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 3,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "4" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -30,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -26,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "5" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "6" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -26,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 3,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "7" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "8" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 3,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -26,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "9" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -30,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "11" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -26,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "12" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -26,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "13" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 6,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 3,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -30,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "14" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "15" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "16" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 2,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "18" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -33,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -28,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "19" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -30,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -25,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 3,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -26,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "20" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 6,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -32,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -28,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -29,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "21" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 5,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -27,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -30,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -29,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    // "22" => [
    //     "MATUTINO" => [
    //         [
    //             "lectura" => 4,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -30,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -28,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ],
    //     "VESPERTINO" => [
    //         [
    //             "lectura" => 3,
    //             "termometro" => 25,
    //             "mes" => 9,
    //             "folio" => "0006"
    //         ],
    //         [
    //             "lectura" => -31,
    //             "termometro" => 21,
    //             "mes" => 9,
    //             "folio" => "0004"
    //         ],
    //         [
    //             "lectura" => -29,
    //             "termometro" => 23,
    //             "mes" => 9,
    //             "folio" => "0005"
    //         ]
    //     ]
    // ],
    "23" => [
        "MATUTINO" => [
            [
                "lectura" => 6,
                "termometro" => 25,
                "mes" => 9,
                "folio" => "0006"
            ],
            [
                "lectura" => -32,
                "termometro" => 21,
                "mes" => 9,
                "folio" => "0004"
            ],
            [
                "lectura" => -27,
                "termometro" => 23,
                "mes" => 9,
                "folio" => "0005"
            ]
        ],
        "VESPERTINO" => [
            [
                "lectura" => 2,
                "termometro" => 25,
                "mes" => 9,
                "folio" => "0006"
            ],
            [
                "lectura" => -30,
                "termometro" => 21,
                "mes" => 9,
                "folio" => "0004"
            ],
            [
                "lectura" => -29,
                "termometro" => 23,
                "mes" => 9,
                "folio" => "0005"
            ]
        ]
    ],
    "25" => [
        "MATUTINO" => [
            [
                "lectura" => 6,
                "termometro" => 25,
                "mes" => 9,
                "folio" => "0006"
            ],
            [
                "lectura" => -31,
                "termometro" => 21,
                "mes" => 9,
                "folio" => "0004"
            ],
            [
                "lectura" => -28,
                "termometro" => 23,
                "mes" => 9,
                "folio" => "0005"
            ]
        ],
        "VESPERTINO" => [
            [
                "lectura" => 4,
                "termometro" => 25,
                "mes" => 9,
                "folio" => "0006"
            ],
            [
                "lectura" => -30,
                "termometro" => 21,
                "mes" => 9,
                "folio" => "0004"
            ],
            [
                "lectura" => -28,
                "termometro" => 23,
                "mes" => 9,
                "folio" => "0005"
            ]
        ]
    ],
];

$master = new Master();

// Suponiendo que ya tienes una conexión PDO llamada $pdo
foreach ($lecturas as $dia => $turnos) {
    foreach ($turnos as $turno => $registros) {
        foreach ($registros as $registro) {
            $lectura = $registro['lectura'];
            $folio = $registro['folio'];
            $fechaRegistro = "2023-09-" . str_pad($dia, 2, '0', STR_PAD_LEFT);

            if ($turno == 'MATUTINO') {
                $hora = rand(7, 12);
            } else {
                $hora = rand(14, 17);
            }

            $fechaModificado = $fechaRegistro . " " . str_pad($hora, 2, '0', STR_PAD_LEFT) . ":00:00";

            $sql = "UPDATE temperatura_registro AS tempr
                    LEFT JOIN temperatura_detalle AS tempd ON tempr.ID_REGISTRO_TEMPERATURA = tempd.REGISTRO_TEMPERATURA_ID
                    LEFT JOIN temperatura_resultados AS tempres ON tempres.ID_FOLIOS_TEMPERATURA = tempd.FOLIOS_TEMPERATURA_ID
                    SET tempr.LECTURA = :lectura, tempr.FECHA_MODIFICADO = :fechaModificado, tempr.ESTATUS = 1
                    WHERE date(tempr.FECHA_REGISTRO) = :fechaRegistro AND tempr.TURNO = :turno AND tempres.FOLIO = :folio AND tempr.ESTATUS = 0";

            echo "Lectura: $lectura <br>";
            echo "Dia: $dia <br>";

            $conn = $master->connectDb();

            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':lectura' => $lectura,
                ':fechaModificado' => $fechaModificado,
                ':fechaRegistro' => $fechaRegistro,
                ':turno' => $turno,
                ':folio' => $folio
            ]);

            // print_r($conn->rowCount());
            $stmt->closeCursor();
            echo "---- <br>";
        }
    }
}
