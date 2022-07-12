# GildedRose Kata - PHP Version

The goal of this refactor was to make the class GildedRose more extensible and updateQuality method more readable.

To achieve that I used:
- constructors to get rid of magic values and make the class more extensible by adding option to add values
- properties like degrade_ratio to reduce repetition
- helper methods to reduce repetition

## Further improvements

To improve the current implementation, I could have, but chose not to, due to the time limit:
- Extend class Item for each special type of item and add interface that would handle the property change operations.

## Running the program

To run the program, please run `php fixtures/texttest_fixture.php` from the root directory.
This will run the program 31 times, however, if you put a number parameter at the end, it will run it as many times  as you specified.
Then you can compare the results with the entries in `tests/approvals/ApprovalTest.testTestFixture.approved.txt`.


## Other info
- Above command could be run by texttest command, but in my case it didn't work, so the equivalent is above.
- Due to me having accidentally reinitialized the repository, there are no changes visible from the original - only the solution. I hope that's okay.

## For any additional info, don't hesitate to contact and ask me via neven.jevtic123@gmail.com