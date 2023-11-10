# myapit.github.io
Personal Website

### Git alias
```
git config --global alias.co checkout
git config --global alias.br branch
git config --global alias.ci commit
git config --global alias.st status
```

```
git config --global alias.last 'log -1 HEAD'
git config --global alias.unstage 'reset HEAD --'
```


## Git Merge
```
git checkout master
git pull
git checkout test
git pull
git merge
```
this will merge test branch to master. but test branch will remain.

### Git Branch Rebase
```
git checkout master
git pull
git checkout test
git pull
git rebase -i master
git checkout master
git merge test
```
when to rebase, all test branch will move to master branch and make project history more clean.
