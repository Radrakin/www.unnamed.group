hint "clothing";

	player forceAddUniform "PRG_CombatFatigues_Urban";
	player addVest "PRG_PlateCarrier2_Urban";
	player addHeadgear "PRG_HelmetB_Light_Urban";
	player addGoggles "VSM_Balaclava2_black_Goggles";

hint "ammunition";

	for "_i" from 1 to 2 do {player addItemToVest "MiniGrenade";};
	for "_i" from 1 to 3 do {player addItemToVest "UK3CB_BAF_SmokeShell";};
	player addItemToVest "ACE_M84";

hint "medical";

	for "_i" from 1 to 15 do {player addItemToUniform "ACE_elasticBandage";};
	for "_i" from 1 to 15 do {player addItemToUniform "ACE_quikclot";};
	for "_i" from 1 to 4 do {player addItemToUniform "ACE_morphine";};
	for "_i" from 1 to 2 do {player addItemToUniform "ACE_epinephrine";};
	for "_i" from 1 to 4 do {player addItemToUniform "ACE_tourniquet";};
	player addItemToVest "ACE_bloodIV_500";

hint "tools";

	player addItemToVest "ACE_Flashlight_KSF1";
	player addItemToVest "ACE_EarPlugs";
	for "_i" from 1 to 2 do {player addItemToVest "ACE_IR_Strobe_Item";};
	player addItemToVest "ACE_EntrenchingTool";
	player addItemToVest "ItemcTabHCam";

hint "equipment";

	player linkItem "ItemMap";
	player linkItem "ItemCompass";
	player linkItem "TFAR_microdagr";
	player linkItem "ItemAndroid";
	player linkItem "CUP_NVG_HMNVS";
	player addWeapon "Rangefinder";

hint "radio";

	player linkItem "TFAR_rf7800str";

hint "loadout applied";
