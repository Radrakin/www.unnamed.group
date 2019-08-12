hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/con") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addWeapon "CUP_launch_MAAWS";
	player addSecondaryWeaponItem "CUP_MAAWS_HEAT_M";

	player addBackpack "PRG_Kitbag_Urban";
	for "_i" from 1 to 1 do {player addItemToBackpack "CUP_MAAWS_HEAT_M";};

hint "items synced, loadout fully applied";

