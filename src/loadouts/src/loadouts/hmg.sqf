hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/basic") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addWeapon "UK3CB_BAF_L7A2";
	player addPrimaryWeaponItem "UK3CB_BAF_762_100Rnd";

	player addBackpack "PRG_Kitbag_Urban";
	for "_i" from 1 to 3 do {player addItemToBackpack "UK3CB_BAF_762_100Rnd";};

hint "items synced, loadout fully applied";

