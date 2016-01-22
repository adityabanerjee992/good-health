<?php

namespace App\Http\Utilities;

class DbDataProvider
{
	
	
public static $productCode=['CB00001',
'CB00002',
'CB00003',
'CB00004',
'CB00005',
'CB00006',
'CB00007',
'CB00008',
'CB00009',
'CB00010',
'CB00011',
'CB00012',
'CB00013',
'CB00014',
'CB00015',
'CB00016',
'CB00017',
'CB00018',
'CB00019',
'CB00020',
'CB00021',
'CB00022',
'CB00023',
'CB00024',
'CB00025',
'CB00027',
'CB00028'];


public static $productName = [
'BRICKCEF-AZ',
'CEPO-AZ',
'CROSSRAB-20',
'CROSSRAB-DSR',
'CROSSTAZ-1GM',
'FEVACROSS-A',
'FEVACROSS-DS',
'FEVACROSS-SUSP',
'FORTBERRY-CAPS',
'FORTBERRY-SYP',
'HEPACROSS-SYP',
'ITRACROSS-100',
'IVERCOSS-A TAB',
'IVERCROSS-A SUSP',
'IVERCROSS-A12',
'KEYCROSS-OZ',
'KOFCROSS-COLD',
'KOFCROSS-L',
'LERGYCROSS-DT',
'LERGYCROSS-M',
'LERGYCROSS-SYP',
'METHYLBERRY-INJ',
'METHYLBERRY-LC',
'MOXICROSS-CV DS',
'MOXICROSS-CV 625',
'MOXICROSS-EYE DROP',
'PODCROSS-DS',
'ZINCOBERRY-SYP'
];

public static $packings= ['1x10',
'1GM',
'60ML',
'200ML',
'1X4',
'1X1',
'10ML',
'100ML',
'1ML',
'5ML',
'30ML',
'20ML',
'40ML',
'50ML',
'70ML',
'80ML',
'90ML',
'12ML',
'2ML',
'3ML',
'4ML',
'51ML',
'6ML',
'7ML',
'8ML',
'9ML',
'11ML',
];

public static $units = [
'UNIT',
'STRIP',
'VIAL',
'BOTTLE',
'Ampules',
'Blisters',
'Bottles',
'Canisters',
'Cartridges',
'Iv Bags',
'Mini-jars',
'Pouches',
'Pre-fillable Syringes',
'Tubes',
'Vials'
];

public static $companies = ['CROSS BERRY'];

public static $categories = 
['TAB',
'INJ',
'SUSP',
'SYP',
'DRY SYP',
'DROPS'];

public static $manufacturers = 
['SHAMSHREE LIFESCIENCES LTD',
'ALTAR SRI LABS PVT .LTD',
'STARMED FORMULATIONS',
'PRIMUS PHARMACEUTICALS',
'GMH LABORATORIES',
'DECCAN HEALTHCARE PVT. LTD',
'SAITECH MEDICARE PVT. LTD',
'G.G. NUTRITIONS',
'RADICO REMEDIES',
'EMBARK LIFESCIENCE PVT. LTD'];

public static $salts = 
['CEFIXIME' , 
'AZITHROMYCIN',
'CEFPODOXIME', 
'RABEPRAZOLE',
'DOMPERIDONE',
'CEFTRIAXONE',
'TAZOBACTAM',
'ACECLOFENAC',
'PARACETAMOL',
'PARACETOMAL ORAL SUSPENSION',
'ANTI- OXIDANTS WITH MINERALS', 
'VITAMINS', 
'GINSENG',
'MULTIVITAMINS', 
'MULTIMINERALS',
'AYURVEDIC LIVER TONIC',
'ITRACONAZOLE',
'IVERMECTIN', 
'ALBENDAZOLE',
'OFLOXACIN', 
'ORNIDAZOLE',
'LEVOCETIRIZINE HYDROCHLORIDE', 
'PHENYLEPHRINE HYDROCHLORIDE', 
'AMBROXOL HYDROCHLORIDE'];


public static $ailments=['Allergic Disorders',
					'Anticancer Therapy',
					'Anaesthesia',
					'Antidotes',
					'Bone and Joint Disorders',
					'Cardiovascular Disorders',
					'Contraceptives',
					'Dermatological Disorders',
					'Diabetes',
					'Diagnostics',
					'Drug Acting on the Uterus',
					'Drugs for Erectile Dysfunction',
					'Ear Disorders',
					'Endocrine Disorders',
					'Gastrointestinal Disorders',
					'Hematologic Disorders',
					'Hepato',
					'Herbal Drugs',
					'Hormonal Disorders',
					'Immune Disorders',
					'Infectious Disorders',
					'Miscellaneous',
					'Muscular Disorders',
					'Neurologic Disorders'
					];


public static $classes=[
					"ANTI DIABETIC",
					"ANTI MALARIALS",
					"ANTI-INFECTIVES",
					"ANTI-NEOPLASTICS",
					"BLOOD RELATED",
					"CARDIAC",
					"DERMA",
					"GASTRO INTESTINAL",
					"GYNAECOLOGICAL",
					"HORMONES",
					"NEURO / CNS",
					"OPHTHAL",
					"OPHTHAL / OTOLOGICALS",
					"OTHERS",
					"OTOLOGICALS",
					"PAIN / ANALGESICS",
					"RESPIRATORY",
					
					"STOMATOLOGICALS",
					"UROLOGY",
					"VACCINES",
					
					 ];


	public static function getPacking()
	{
		return array_shift(static::$packings);
	}	

	public static function getProductName()
	{
		return array_shift(static::$productName);
	}

	public static function getProductCode()
	{
		return array_shift(static::$productCode);
	}	

	public static function getClasses()
	{
		return array_shift(static::$classes);
	}	

	public static function getAilment()
	{
		return array_shift(static::$ailments);
	}

	public static function getSalt()
	{
		return array_shift(static::$salts);
	}

	public static function getManufacturer()
	{
		return array_shift(static::$manufacturers);
	}

	public static function getCategory()
	{
		return array_shift(static::$categories);
	}

	public static function getCompany()
	{
		return array_shift(static::$companies);
	}

	public static function getUnit()
	{
		return array_shift(static::$units);
	}
}