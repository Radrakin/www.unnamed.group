hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/basic") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player addBackpack "PRG_Kitbag_Urban";

hint "items synced, loadout fully applied";
