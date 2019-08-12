hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/basic") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addWeapon "CUP_arifle_M4A3_black";
	player addPrimaryWeaponItem "ACE_muzzle_mzls_L";
	player addPrimaryWeaponItem "KA_ANPEQ15_Black_IR";
	player addPrimaryWeaponItem "rhsusf_acc_su230a_mrds";
	player addPrimaryWeaponItem "rhsusf_acc_harris_bipod";
	player addPrimaryWeaponItem "CUP_30Rnd_556x45_Emag";

	for "_i" from 1 to 6 do {player addItemToVest "CUP_30Rnd_556x45_Emag";};

hint "items synced, loadout fully applied";

