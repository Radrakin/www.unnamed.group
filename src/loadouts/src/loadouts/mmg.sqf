hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/basic") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addWeapon "CUP_lmg_M60E4";
	player addPrimaryWeaponItem "CUP_100Rnd_TE4_LRT4_Red_Tracer_762x51_Belt_M";
	player addPrimaryWeaponItem "rhsusf_acc_acog3";

	player addBackpack "PRG_Kitbag_Urban";
	for "_i" from 1 to 3 do {player addItemToBackpack "CUP_100Rnd_TE4_LRT4_Red_Tracer_762x51_Belt_M";};

hint "items synced, loadout fully applied";

