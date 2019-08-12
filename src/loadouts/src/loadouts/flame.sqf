hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/basic") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addWeapon "M2_Flamethrower_01_F";
	player addPrimaryWeaponItem "M2_Fuel_Tank";
	player addBackpack "M2_Flamethrower_Balloons_Pipe";

hint "items synced, loadout fully applied";

