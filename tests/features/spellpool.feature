Feature: spellpool
  Who/what/where/why
  If I am the wizard "ron weasley" with a simple spell pool, I should only have a few limited spells available to me when I view my pool

  Scenario:
  	Given I am the wizard "ron weasley"
  	Given I have the spells "fireball", "magic-missile", "wall"
  	Then when I view my spell pool, I should only have the given spells
