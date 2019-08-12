hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/con") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addWeapon "launch_I_Titan_short_F";
	player addSecondaryWeaponItem "Titan_AT";

	player addBackpack "PRG_Kitbag_Urban";
	for "_i" from 1 to 1 do {player addItemToBackpack "Titan_AT";};

hint "items synced, loadout fully applied";

