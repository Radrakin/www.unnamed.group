# Radio Communication Basics

## 1. Introduction

This chapter cover the use of radio and contain all information you should need to properly operate your radio during an operation.

The goal is to allow you to get a quick understanding of what we expect regarding the use of radio and how you should communicate with your fellow members. Good communication is a very important part of any operation as it will greatly improve the experience of everyone involved.

## 2. Radio Protocols

1. Make sure that your message is **clear**.
2. Keep messages as **short and sweet** as possible.
3. Always acknowledge that you **recieved and understood** the order given.
4. If your last message had **wrong information**, **correct it immediately** and **send** again.

## 3. Radio Configuration Reference

| Parent Group | Element | Radio Configuration |
|:------------:|:------------:|:------------------------:|
| Crossroads | Command Team | <u>Unit Commander</u><br/>1. 343: Block 1 - Channel 1<br/>2. 152: Channel 1<br/><u>Unit RTC/JTAC</u><br/>1. 343: Block 1 - Channel 1<br/>2. 343: Block 1 - Channel 1<br/>3. 152: Channel 1<br/>4. 152: Channel 8<br/>5. 117F: Channel 9 |
| Wolfpack | Section Command Team | <u>Section Commander</u><br/>1. 343: Block 2 - Channel 1<br/>2. 152: Channel 2<br/><u>Section Medic</u><br/>1. 343: Block 2 - Channel 1<br/>2. 343: Block 2 - Channel 1<br/>3. 152: Channel 2 |
| Wolfpack | Base-of-Fire Team | <u>Fireteam Leader</u><br/>1. 343: Block 2 - Channel 2<br/>2. 152: Channel 2<br/><u>Everyone Else</u><br/>1. 343: Block 2 - Channel 2 |
| Wolfpack | Assault Team Alpha | <u>Fireteam Leader</u><br/>1. 343: Block 2 - Channel 3<br/>2. 152: Channel 2<br/><u>Everyone Else</u><br/>1. 343: Block 2 - Channel 3 |
| Wolfpack | Assault Team Bravo | <u>Fireteam Leader</u><br/>1. 343: Block 2 - Channel 4<br/>2. 152: Channel 2<br/><u>Everyone Else</u><br/>1. 343: Block 2 - Channel 4 |
| Hammer | Hand Mortar Battery | <u>Fire-Data Controller</u><br/>1. 343: Block 5 - Channel 8<br/>2. 152: Channel 8<br/><u>Everyone Else</u><br/>1. 343: Block 5 - Channel 8 |
| Arrow | All Elements | <u>Everyone</u><br/>1. 343: Block 5 - Channel 9<br/>2. 152: Channel 9 |

## 4. Radio Operator

The Radio Operator (RTO) is the link between the Commander and all other elements. His role is to monitor all relevant radio channels and to relay communications between the different elements and to transmit the commander orders.

To achieve this, the RTO is expected to carry as many radios as necessary. For example, For one Section (like wolfpack) and one artillery battery (hammer), the RTO loadout would be :

- 2 x 343 
  - 1 for the command squad the RTO is part of
  - 1 for any squad the RTO may need to contact or attach himself to
- 3 x 152
  - 1 for radio channel to contact Command Team (Crossroads)
  - 1 for radio channel to contact the section elements (wolfpack)
  - 1 for radio channel to contact the artilery element (hammer)


More radios may be required to cover all the channels depending on the elements present during an operation. The use of a 117 may be required for elements operating farther away.

During an operation, you will have to switch your PTT between the different radios to talk on the different radio channels (you will always hear from all the radios even those you are not speaking into). You can for example set your radios as follow :
- PTT 1 : 343 radios
- PTT 2 : 152 radios 
- PTT 3 : 117 radios

When switching between active radios, you will just have to set the PTT using ACE interact.

## 5. Keywords

| Keyword | Meaning | Example |
|:-:|:-:|:-:|
| Over | The end of a message. | **Section Command**: Alpha this is Crossroads over. |
| Send | The reciever is ready to hear the message. | **Section Command**: Alpha this is Crossroads over.<br/>**Assault Team Alpha**: This is Alpha, send over. |
| Out | End of the radio conversation. | Example Below. |
| Roger/Copy | Yes I understood your message. | **Section Command**: Alpha this is Crossroads over.<br/>**Assault Team Alpha**: This is Alpha, send over.<br/>**Section Command**: Alpha move to waypoint marker 2.<br/>**Assault Team Alpha**: Roger out.|
| Say Again | Repeat last message. | **Section Command**: Alpha this is Crossroads over.<br/>**Assault Team Alpha**: This is Alpha, send over.<br/>**Section Command**: Alpha move to waypoint marker 2.<br/>**Assault Team Alpha**: Say again over.<br/>**Section Command**: Alpha move to waypoint marker 2.<br/>**Assault Team Alpha**: Roger out.|
| Target | Hostile targets that are not engaging you or friendly forces. | **Assault Team Alpha**: This is Alpha to Crossroads over.<br/>**Section Command**: This is Crossroads send.<br/>**Assault Team Alpha**: Spotted hard target bearing 230 from our position. Over<br/>**Section Command**: Roger that Alpha, maintain distance do not engage. Over.<br/>**Assault Team Alpha**: Roger that. Alpha Out.|
| Soft | Lightly armoured targets such as infantry and light vehicles. | N/A |
| Hard | Heavy armoured targets such as tanks and other heavy vehicles. | N/A |
| Bogey | Aerial targets such as helicopters and airplanes. | N/A |
| Contact | Used when your team is under fire. | **Assault Team Alpha**: Crossroads this is Alpha. Soft contact, firing at will. Over.<br/>**Section Command**: Roger that Alpha. All elements begin the assault. Over.<br/>**Assault Team Alpha**: This is Alpha. Roger out.<br/>**Assault Team Bravo**: This is Bravo. Roger out.<br/>**Base-of-Fire Team**: This is Base-of-Fire. Roger out.|
| Break | This is typically used to break up a long message in case<br/>you need to check something before continuing. | **Assault Team Alpha**: This is Alpha to Crossroads over.<br/>**Section Command**: This is Crossroads send.<br/>**Assault Team Alpha**: Spotted hard contact bearing 230 from our position break-<br/>**Assault Team Alpha**: Grid location 426 801, keypad 4 over.<br/>**Section Command**: Roger that Alpha, sending Eagle to support. Out.|
