hint "applying base loadout"; sleep 1;

	("https://loadouts.unnamed.group/con") execvm "arsenal_fetch.sqf";

hint "base loadout applied, adding overlay"; sleep 1;

    player addBackpack "PRG_Kitbag_Urban";
    for "_i" from 1 to 40 do {player addItemToBackpack "ACE_elasticBandage";};
    for "_i" from 1 to 15 do {player addItemToBackpack "ACE_quikclot";};
    player addItemToBackpack "adv_aceCPR_AED";
    player addItemToBackpack "ACE_surgicalKit";
    for "_i" from 1 to 8 do {player addItemToBackpack "ACE_tourniquet";};
    for "_i" from 1 to 3 do {player addItemToBackpack "adv_aceSplint_splint";};
    for "_i" from 1 to 25 do {player addItemToBackpack "ACE_morphine";};
    for "_i" from 1 to 15 do {player addItemToBackpack "ACE_epinephrine";};
    for "_i" from 1 to 10 do {player addItemToBackpack "ACE_bloodIV";};
    player addItemToBackpack "ACE_SpraypaintBlue";
    for "_i" from 1 to 5 do {player addItemToBackpack "ACE_bloodIV_250";};

hint "items synced, loadout fully applied";

