hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/con") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

	player linkItem "TFAR_anprc152";

	player addBackpack "PRG_Kitbag_Urban";
	for "_i" from 1 to 2 do {player addItemToUniform "SmokeShell";};
	player addItemToBackpack "SmokeShellGreen";
	player addItemToBackpack "SmokeShellRed";
	player addItemToBackpack "SmokeShellYellow";
	player addItemToBackpack "SmokeShellBlue";
	player addItemToBackpack "SmokeShellPurple";
	player addItemToBackpack "SmokeShellOrange";

hint "items synced, loadout fully applied";

