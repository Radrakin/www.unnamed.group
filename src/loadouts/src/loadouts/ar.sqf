hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/basic") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addWeapon "CUP_lmg_M249_E2";
	player addPrimaryWeaponItem "CUP_200Rnd_TE1_Red_Tracer_556x45_M249";
	player addPrimaryWeaponItem "cup_optic_holoblack";

	player addBackpack "PRG_Kitbag_Urban";
	for "_i" from 1 to 3 do {player addItemToBackpack "CUP_200Rnd_TE1_Red_Tracer_556x45_M249";};

hint "items synced, loadout fully applied";

